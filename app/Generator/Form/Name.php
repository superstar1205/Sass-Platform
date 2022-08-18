<?php
namespace App\Generator\Form;

class Name extends Input
{
    public string $view = 'form.name';

    public function __construct(array $params)
    {
        parent::__construct($params);
        $this->type = "text";
    }
}