<?php
namespace Tests\Generator\Form;

use App\Generator\Form\ThinkYouPage;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Tests\Generator\Fixture\ThinkYouPageData;
use Tests\TestCase;

class ThinkYouPageTest extends TestCase
{
    public function test_it_can_render()
    {
        $data = ThinkYouPageData::get();
        $thinkYouPage = new ThinkYouPage($data);

        $this->assertEquals('form.thinkyou', $thinkYouPage->view);
        $this->assertInstanceOf(View::class, $thinkYouPage->render());

        $blocks = [];

        foreach (data_get($data, 'blocks') as $block) {
            $blockClass = "App\\Generator\\Form\\" . Str::of($block['type'])->camel()->ucfirst();
            if (class_exists($blockClass)) {
                $blocks[] = new $blockClass($block);
            }
        }

        $this->assertEquals([
            'blocks' => $blocks
        ], $thinkYouPage->render()->getData());


    }
}