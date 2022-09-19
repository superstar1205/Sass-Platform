<?php
namespace Tests\Generator\Form;

use App\Generator\Form\Checkbox;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Tests\TestCase;

class CheckboxTest extends TestCase
{
    public function test_it_can_render()
    {
        $data = [
            'id' => Str::uuid(),
            'options' => [
                [
                    'id' => Str::uuid(),
                    'value' => Str::uuid()
                ],
                [
                    'id' => Str::uuid(),
                    'value' => Str::uuid()
                ],
                [
                    'id' => Str::uuid(),
                    'value' => Str::uuid()
                ]
            ],
            'required' => false,
            'label' => Str::uuid()
        ];

        $checkbox = new Checkbox($data);

        $this->assertEquals('form.checkbox', $checkbox->view);


        $this->assertInstanceOf(View::class, $checkbox->render());

        $this->assertEquals($data, $checkbox->render()->getData());

    }
}