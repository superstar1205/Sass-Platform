<?php
namespace Tests\Generator\Form;

use App\Generator\Form\Hidden;
use Illuminate\View\View;
use Tests\Generator\Fixture\InputData;
use Tests\TestCase;

class HiddenTest extends TestCase
{
    public function test_it_can_render()
    {
        $data = InputData::get();

        $hidden = new Hidden($data);

        $this->assertEquals('form.hidden', $hidden->view);

        $this->assertInstanceOf(View::class, $hidden->render());

        $this->assertEquals($data, $hidden->render()->getData());
    }
}