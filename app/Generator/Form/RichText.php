<?php
namespace App\Generator\Form;

use Illuminate\Contracts\Support\Renderable;

class RichText implements Renderable
{
    public string $view = "form.rich_text";
    public string $content;
    public string $id;

    public function __construct(array $params)
    {
        $this->content = data_get($params, 'content', '');
        $this->id = data_get($params, 'id');
    }

    public function render()
    {
        return view($this->view, [
            'content' => $this->content,
            'id' => $this->id
        ]);
    }
}