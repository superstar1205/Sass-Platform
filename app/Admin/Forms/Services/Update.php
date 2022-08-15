<?php
namespace App\Admin\Forms\Services;

use Illuminate\Database\Eloquent\Model;
use Throwable;

class Update
{
    /**
     * @param  Model  $form
     * @param  string  $title
     * @param  array  $metaData
     * @param  string  $userId
     * @throws Throwable
     */
    public function execute(
        Model $form,
        string $title,
        array $metaData,
        string $userId,
    ): void {
        $form->title = $title;
        $form->meta_data = $metaData;
        $form->user_id = $userId;
        $form->saveOrFail();
    }
}