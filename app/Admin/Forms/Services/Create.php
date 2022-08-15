<?php
namespace App\Admin\Forms\Services;

use App\Models\Form;
use App\Models\User;

class Create
{
    /**
     * @param  string  $title
     * @param  array  $metaData
     * @param  User  $user
     */
    public function execute(
        string $title,
        array $metaData,
        User $user
    ):void {
        Form::query()->create([
            'title' => $title,
            'meta_data' => $metaData,
            'user_id' => $user->id
        ]);
    }
}