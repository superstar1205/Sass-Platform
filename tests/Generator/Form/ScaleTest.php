<?php
namespace Tests\Generator\Form;

use App\Generator\Form\Scale;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\View\View;
use Tests\Generator\Fixture\ScaleData;
use Tests\TestCase;

class ScaleTest extends TestCase
{
    public function test_it_can_render()
    {
        $data = ScaleData::get();
        $scale = new Scale($data);

        $this->assertInstanceOf(Renderable::class, $scale);

        $this->assertInstanceOf(View::class, $scale->render());

        $this->assertEquals($data['min'], data_get($scale->render()->getData(), 'min'));
    }
}