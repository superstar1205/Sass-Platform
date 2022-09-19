<?php
namespace Tests\Generator\Form;

use App\Generator\Form\Email;
use Illuminate\View\View;
use Tests\Generator\Fixture\InputData;
use Tests\TestCase;

class EmailTest extends TestCase
{
    public function test_it_can_render()
    {
        $data = InputData::get();

        $data['type'] = 'url';

        $email = new Email($data);

        $this->assertEquals('form.email', $email->view);


        $this->assertInstanceOf(View::class, $email->render());

        $this->assertEquals($data, $email->render()->getData());

    }
}