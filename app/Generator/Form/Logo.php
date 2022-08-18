<?php
namespace App\Generator\Form;

use Illuminate\Contracts\Support\Renderable;

class Logo implements Renderable
{
    public string $view = "form.logo";

    public ?string $src;

    public ?string $class;

    public function __construct(array $params)
    {
        $this->src = data_get($params, 'src');
        $this->class = data_get($params, 'class');
    }
    public function render()
    {
        return view($this->view, [
            'src' => $this->src,
            'class' => $this->class,
        ]);
    }
}