<?php
namespace Tests\Generator\Form;

use App\Generator\Form\Name;
use Illuminate\View\View;
use Tests\Generator\Fixture\InputData;
use Tests\TestCase;

class NameTest extends TestCase
{
    public function test_it_can_render()
    {
        $data = InputData::get();

        $name = new Name($data);

        $this->assertEquals('form.name', $name->view);

        $this->assertEquals('text', $name->type);

        $this->assertInstanceOf(View::class, $name->render());

        $this->assertEquals($data, $name->render()->getData());
    }
}