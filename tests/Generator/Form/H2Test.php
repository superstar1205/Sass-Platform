<?php
namespace Tests\Generator\Form;

use App\Generator\Form\H2;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\View\View;
use Tests\Generator\Fixture\H2Data;
use Tests\TestCase;

class H2Test extends TestCase
{
    public function test_it_can_render()
    {
        $data = H2Data::get();
        $h2 = new H2($data);

        $this->assertInstanceOf(Renderable::class, $h2);

        $this->assertInstanceOf(View::class, $h2->render());

        $this->assertEquals($data['content'], data_get($h2->render()->getData(), 'content'));

    }
}