<?php
namespace App\Admin\Responses\Repositories;

use App\Models\Response;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class ResponseRepository
{
    /**
     * @param  array  $metaData
     * @return array
     */
    public function getHeadersByMetaData(array $metaData): array
    {
        return array_map(fn($header) => [
            'label' => $header['label'] ?? 'Enter a question',
            'id' => $header['id']
        ], array_filter(MetaDataRepository::make($metaData)->blocks(), fn($header) => count($header) > 3));
    }

    /**
     * @param  array  $headers
     * @param  array  $formDatas
     * @return array
     */
    public function getRows(array $headers, array $formDatas):array
    {
        return array_map(fn(array $formData) => array_reduce($headers,
            function ($initial, $header) use ($formData) {
                $val = data_get($formData, $header['id'], "N/A");
                $initial[] = is_array($val) ? json_encode($val, true) : $val;
                return $initial;
            }, []), $formDatas);
    }

    /**
     * @param  string  $key
     * @param  int|null  $formId
     * @return Collection
     */
    public function pluck(string $key, ?int $formId = null): Collection
    {
        return Response::query()
            ->with('form')
            ->when($formId, fn(Builder $builder) => $builder->where('form_id', $formId))
            ->latest()
            ->pluck($key);
    }
}