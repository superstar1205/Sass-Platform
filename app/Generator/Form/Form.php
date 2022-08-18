<?php
namespace App\Generator\Form;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;

class Form implements Renderable
{
    public string $view = 'form.form';

    public array $blocks = [];

    public static string $method = "POST";

    public static string $action = '';

    public Button $button;

    public ?Logo $logo;

    public int $currentPage;

    public function __construct(array $params, $currentPage)
    {
        $this->currentPage = $currentPage;

        $blocks = data_get($params, 'blocks');

        foreach ($blocks as $block) {
            $blockClass = "App\\Generator\\Form\\" . Str::of($block['type'])->camel()->ucfirst();
            if (class_exists($blockClass)) {
                $this->blocks[] = new $blockClass($block);
            }
        }

        $this->button = new Button(data_get($params, 'button'));
        $this->logo = new Logo(data_get($params, 'logo'));
    }


    public static function setMethod(string $method): void
    {
        self::$method = Str::upper($method);
    }


    public static function setAction(string $action): void
    {
        self::$action = $action;
    }

    public function render(): View
    {
        return view($this->view, [
            'blocks' => $this->blocks,
            'button' => $this->button ?? '',
            'method' => self::$method,
            'action' => self::$action,
            'currentPage' => $this->currentPage,
            'logo' => $this->logo,
        ]);
    }
}