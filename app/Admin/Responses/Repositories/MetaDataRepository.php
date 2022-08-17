<?php
namespace App\Admin\Responses\Repositories;

use Illuminate\Support\Arr;

class MetaDataRepository
{
    /**
     * @var array
     */
    public array $data;

    /**
     * MetaData constructor.
     * @param  array  $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @param  array  $data
     * @return $this
     */
    public function set(array $data): MetaDataRepository
    {
        $this->data = $data;
        return $this;
    }


    public function get(?string $key = null)
    {
        return $key ? Arr::get($this->data, $key, []) : $this->data;
    }

    /**
     * @return array
     */
    public function blocks(): array
    {
        return Arr::collapse(Arr::pluck($this->get('pages'), 'blocks'));
    }

    /**
     * @param  array  $data
     * @return static
     */
    public static function make(array $data): MetaDataRepository
    {
        return new static($data);
    }
}