<?php
namespace Tests\Generator\Form;

use App\Generator\Form\Text;
use Illuminate\View\View;
use Tests\Generator\Fixture\InputData;
use Tests\TestCase;

class TextTest extends TestCase
{
    public function test_it_can_render()
    {
        $data = InputData::get();

        $text = new Text($data);

        $this->assertEquals('form.input', $text->view);

        $this->assertInstanceOf(View::class, $text->render());

        $this->assertEquals($data, $text->render()->getData());
    }
}