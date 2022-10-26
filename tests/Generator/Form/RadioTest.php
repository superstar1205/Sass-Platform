<?php
namespace Tests\Generator\Form;

use App\Generator\Form\Radio;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Tests\TestCase;

class RadioTest extends TestCase
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

        $radio = new Radio($data);

        $this->assertEquals('form.radio', $radio->view);


        $this->assertInstanceOf(View::class, $radio->render());

        $this->assertEquals($data, $radio->render()->getData());

    }
}