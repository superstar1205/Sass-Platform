<?php
namespace Tests\Generator\Form;

use App\Generator\Form\Url;
use Illuminate\View\View;
use Tests\Generator\Fixture\InputData;
use Tests\TestCase;

class UrlTest extends TestCase
{
    public function test_it_can_render()
    {
        $data = InputData::get();

        $data['type'] = 'url';

        $url = new Url($data);

        $this->assertEquals('form.url', $url->view);

        $this->assertEquals('url', $url->type);

        $this->assertInstanceOf(View::class, $url->render());

        $this->assertEquals($data, $url->render()->getData());

    }
}