<?php
namespace App\Generator\Form;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Contracts\View\View;

class Page implements Renderable
{
    protected string $view = 'form.page';

    protected array $blocks = [];

    protected ?Form $form = null;

    protected ?ThinkYouPage $thinkYouPage = null;

    public function getForm(): ?Form
    {
        return $this->form;
    }

    public function getThinkYouPage(): ?ThinkYouPage
    {
        return $this->thinkYouPage;
    }

    public function __construct(array $params, $currentPage)
    {
        if (intval($currentPage) > 0) {
            $this->form = new Form($params, $currentPage);
        } else if ($currentPage === "thank_you_page") {
            $this->thinkYouPage = new ThinkYouPage($params);
        }
    }
    public function render(): View
    {
        return view($this->view, [
            'form' => $this->form,
            'thinkYouPage' => $this->thinkYouPage
        ]);
    }
}