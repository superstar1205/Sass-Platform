<?php
namespace App\Generator\Form;

use Illuminate\Contracts\Support\Renderable;

abstract class Input implements Renderable
{
    public string $id;
    public string $view = 'form.input';

    public ?string $type;

    public ?string $label;

    public bool $required;

    public ?string $placeholder;

    public ?string $help;

    public function __construct(array $params)
    {
        $this->id = data_get($params, 'id');
        $this->type = data_get($params, 'type');
        $this->label = data_get($params, 'label');
        $this->required = data_get($params, 'required');
        $this->placeholder = data_get($params, 'placeholder');
        $this->help = data_get($params, 'help');
    }

    public function render()
    {
        return view($this->view, [
            'id' => $this->id,
            'type' => $this->type,
            'label' => $this->label,
            'required' => $this->required,
            'placeholder' => $this->placeholder,
            'help' => $this->help
        ]);
    }
}