<?php
namespace App\Generator\Form;

use Illuminate\Contracts\Support\Renderable;

class H1 implements Renderable
{
    public string $view = "form.h1";
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