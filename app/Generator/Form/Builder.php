<?php
namespace App\Generator\Form;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\View;

class Builder implements Renderable
{
    public string $title;

    public string $slug;

    public string $view = 'form.container';

    public Page $page;

    public $currentPage;

    /**
     * @return View
     */
    public function render(): View
    {
        $data = [
            'title' => $this->title,
            'page' => $this->page,
            'currentPage' => $this->currentPage
        ];
        return view($this->view, $data);
    }

    public function __construct(array $params)
    {
        $this->currentPage = data_get($params, 'current_page');

        if (intval($this->currentPage) > 0) {

            $pageParams =  data_get(data_get($params, 'pages'), $this->currentPage - 1);

            $pageParams = $this->appendButtonToPage(data_get($params, 'branding'), $pageParams);

            $pageParams = $this->appendLogoToPage(data_get($params, 'branding'), $pageParams);

            $this->page = new Page($pageParams, $this->currentPage);

        } else if($this->currentPage === "thank_you_page") {
            $this->page = new Page(data_get($params, 'thank_you_page'), $this->currentPage);
        }

        $this->title = data_get($params, 'name');
    }

    /**
     * @param  array  $branding
     * @param  array  $pageParams
     * @return array
     */
    public function appendButtonToPage(array $branding, array $pageParams): array
    {
        $btn =  [
            'text' => $pageParams['button'],
            'text_color' => data_get($branding, 'button'),
            'bg_color' => data_get($branding, 'primary_color'),
        ];
        $pageParams['button'] = $btn;

        return $pageParams;
    }

    public function appendLogoToPage(array $branding, array $pageParams): array
    {
        $logo = [
            'src' => data_get($branding, 'logo'),
            'class' => $this->formLogoClass(data_get($branding, 'logoSize')),
        ];
        $pageParams['logo'] = $logo;

        return $pageParams;
    }

    private function formLogoClass($size)
    {
        if ('large'==$size) {
            return 'w-full';
        }

        if ('medium'==$size) {
            return 'w-1/2';
        }

        if ('small'==$size) {
            return 'w-1/4';
        }
    }

    public static function make($params)
    {
        return new static($params);
    }
}
