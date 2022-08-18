<?php
namespace App\Generator\Form;

use Illuminate\Contracts\Support\Renderable;

class H2 implements Renderable
{
    public string $view = "form.h2";
    public ?string $content;


    public function __construct(array $params)
    {
        $this->content = data_get($params, 'content');
    }

    public function render()
    {
        return view($this->view,  ['content' => $this->content]);
    }
}