<?php
namespace Tests\Generator\Form;

use App\Generator\Form\Logo;
use Illuminate\View\View;
use Tests\TestCase;

class LogoTest extends TestCase
{
    public function test_it_can_render()
    {
        $data = [
            'src' => 'http://127.0.0.1:8001/storage/images/cXAuZCdMOHYBDXw083yYRQ2PVOMTV5GabmynwOTE.png',
            'class' => 'small',
        ];

        $logo = new Logo($data);

        $this->assertEquals('form.logo', $logo->view);

        $this->assertInstanceOf(View::class, $logo->render());

        $this->assertEquals($data, $logo->render()->getData());
    }
}