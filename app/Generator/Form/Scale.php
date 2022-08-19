<?php
namespace App\Generator\Form;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\View;

class Scale implements Renderable
{
    public string $view = "form.scale";
    public ?int $min = null;
    public ?int $max = null;
    public ?string $help = null;
    public ?string $label = null;
    public bool $required = false;
    public ?string $toLabel = null;
    public ?string $fromLabel = null;
    public ?string $centerLabel = null;
    public string $id;

    public function __construct(array $params)
    {
        $this->min = data_get($params, 'min');
        $this->max = data_get($params, 'max');
        $this->help = data_get($params, 'help');
        $this->label = data_get($params, 'label');
        $this->required = data_get($params, 'required');
        $this->toLabel = data_get($params, 'to_label');
        $this->fromLabel = data_get($params, 'from_label');
        $this->centerLabel = data_get($params, 'center_label');
        $this->id = data_get($params, 'id');
    }

    /**
     * @return View
     */
    public function render(): View
    {
        return view($this->view, [
            'min' => $this->min,
            'max' => $this->max,
            'help' => $this->help,
            'label' => $this->label,
            'required' => $this->required,
            'toLabel' => $this->toLabel,
            'fromLabel' => $this->fromLabel,
            'centerLabel' => $this->centerLabel,
            'id' => $this->id
        ]);
    }
}