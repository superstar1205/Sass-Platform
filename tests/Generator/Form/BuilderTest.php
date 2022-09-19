<?php
namespace Tests\Generator\Form;

use App\Generator\Form\Builder;
use App\Generator\Form\Form;
use App\Generator\Form\Page;
use App\Generator\Form\ThinkYouPage;
use Tests\Generator\Fixture\MetaData;
use Tests\TestCase;

class BuilderTest extends TestCase
{
    public function test_it_can_render_form_page()
    {
        $data = MetaData::get();

        $builder = Builder::make($data);

        $this->assertEquals('form.container', $builder->view);

        $currentPage = data_get($data,'current_page');

        $pageParams = data_get(data_get($data, 'pages'), $currentPage - 1);

        $pageParams = $builder->appendButtonToPage(data_get($data, 'branding'), $pageParams);
        $pageParams = $builder->appendLogoToPage(data_get($data, 'branding'), $pageParams);

        $this->assertEquals([
            'title' => data_get($data,'name'),
            'page' => new Page($pageParams, $currentPage),
            'currentPage' => $currentPage
        ], $builder->render()->getData());

        $this->assertInstanceOf(Form::class, data_get($builder->render()->getData(), 'page')->getForm());

        $this->assertEquals(Null, data_get($builder->render()->getData(), 'page')->getThinkYouPage());
    }

    public function test_it_can_render_think_you_page()
    {
        $data = MetaData::get();

        $data['current_page'] = 'thank_you_page';

        $builder = Builder::make($data);

        $currentPage = 'thank_you_page';

        $this->assertEquals([
            'title' => data_get($data,'name'),
            'page' => new Page(data_get($data, 'thank_you_page'), $currentPage),
            'currentPage' => $currentPage
        ], $builder->render()->getData());

        $this->assertInstanceOf(ThinkYouPage::class, data_get($builder->render()->getData(), 'page')->getThinkYouPage());

        $this->assertEquals(Null, data_get($builder->render()->getData(), 'page')->getForm());
    }
}