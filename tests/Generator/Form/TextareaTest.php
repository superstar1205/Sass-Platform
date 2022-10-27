<?php
namespace Tests\Generator\Form;

use App\Generator\Form\Textarea;
use Illuminate\View\View;
use Tests\Generator\Fixture\InputData;
use Tests\TestCase;

class TextareaTest extends TestCase
{
    public function test_it_can_render()
    {
        $data = InputData::get();

        $data['type'] = 'textarea';

        $textarea = new Textarea($data);

        $this->assertEquals('form.textarea', $textarea->view);

        $this->assertEquals('textarea', $textarea->type);

        $this->assertInstanceOf(View::class, $textarea->render());

        $this->assertEquals($data, $textarea->render()->getData());
    }
}