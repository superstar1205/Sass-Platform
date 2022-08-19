<?php
namespace App\Generator\Form;

use Illuminate\Contracts\Support\Renderable;

class Radio implements Renderable
{
    public string $view = "form.radio";
    public ?string $label;
    public string $id;
    public array $options;
    public bool $required;
    public ?string $help;

    public function __construct(array $params)
    {
        $this->options = data_get($params, 'options');
        $this->label = data_get($params, 'label');
        $this->id = data_get($params, 'id');
        $this->required = data_get($params, 'required');
        $this->help = data_get($params, 'help');
    }

    public function render()
    {
        return view($this->view,  [
            'id' => $this->id,
            'options' => $this->options,
            'required' => $this->required,
            'label' => $this->label
        ]);
    }


}