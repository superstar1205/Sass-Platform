<?php
namespace Tests\Generator\Form;

use App\Generator\Form\Button;
use App\Generator\Form\Form;
use App\Generator\Form\Logo;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Tests\Generator\Fixture\FormData;
use Tests\TestCase;

class FormTest extends TestCase
{
    public function test_it_can_render()
    {
        $data = FormData::getByInitBtn();

        $method = 'POST';
        $action = Str::uuid();
        $currentPage = 1;
        $button = new Button(data_get($data, 'button'));
        $logo = new Logo(data_get($data, 'logo'));

        Form::setMethod($method);
        Form::setAction($action);

        $form = new Form($data, $currentPage);

        $this->assertEquals('form.form', $form->view);

        $this->assertEquals($button, $form->button);

        $this->assertInstanceOf(View::class, $form->render());

        $blocks = [];

        foreach (data_get($data, 'blocks') as $block) {
            $blockClass = "App\\Generator\\Form\\" . Str::of($block['type'])->camel()->ucfirst();
            if (class_exists($blockClass)) {
                $blocks[] = new $blockClass($block);
            }
        }

        $this->assertEquals([
            'blocks' => $blocks,
            'button' => $button,
            'method' => $method,
            'action' => $action,
            'currentPage' => $currentPage,
            'logo' => $logo
        ], $form->render()->getData());
    }

}