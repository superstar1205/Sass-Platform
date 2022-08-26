<?php
namespace App\Generator\Form;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;

class ThinkYouPage implements Renderable
{
    public array $blocks = [];

    public string $view = 'form.thinkyou';

    public function __construct(array $params)
    {
        $blocks = data_get($params, 'blocks');

        foreach ($blocks as $block) {
            $blockClass = "App\\Generator\\Form\\" . Str::of($block['type'])->camel()->ucfirst();
            if (class_exists($blockClass)) {
                $this->blocks[] = new $blockClass($block);
            }
        }
    }
    public function render(): View
    {
        return view($this->view, [
            'blocks' => $this->blocks,
        ]);
    }
}