<?php
namespace Tests\Generator\Form;

use App\Generator\Form\Form;
use App\Generator\Form\Page;
use App\Generator\Form\ThinkYouPage;
use Tests\Generator\Fixture\FormData;
use Tests\TestCase;

class PageTest extends TestCase
{
    public function test_it_can_render()
    {
        $page = new Page(FormData::getByInitBtn(),1);

        $this->assertInstanceOf(Form::class, $page->getForm());

        $page = new Page(FormData::getByInitBtn(),'thank_you_page');

        $this->assertInstanceOf(ThinkYouPage::class, $page->getThinkYouPage());
    }
}