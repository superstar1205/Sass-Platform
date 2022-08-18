<?php
namespace App\Generator\Form;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\View;

class Button implements Renderable
{
    protected string $view = 'form.button';

    public string $text;

    public string $textColor;

    public string $bgColor;


    public function __construct(array $params)
    {
        $this->text = data_get($params, 'text');
        $this->textColor = data_get($params, 'text_color');
        $this->bgColor = data_get($params, 'bg_color');
    }

    public function render():View
    {
        return view($this->view, [
            'text' => $this->text,
            'text_color' => $this->textColor,
            'bg_color' => $this->bgColor
        ]);
    }
}