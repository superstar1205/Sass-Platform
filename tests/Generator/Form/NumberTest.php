<?php
namespace Tests\Generator\Form;

use App\Generator\Form\Number;
use Illuminate\View\View;
use Tests\Generator\Fixture\InputData;
use Tests\TestCase;

class NumberTest extends TestCase
{
    public function test_it_can_render()
    {
        $data = InputData::get();

        $number = new Number($data);

        $this->assertEquals('form.number', $number->view);

        $this->assertInstanceOf(View::class, $number->render());

        $this->assertEquals($data, $number->render()->getData());
    }
}