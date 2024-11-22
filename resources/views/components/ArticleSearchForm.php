<?php

namespace App\View\Components;

use Illuminate\View\Component;

class ArticleSearchForm extends Component
{
    public $title;
    public $subtitle;
    public $action;
    public $publishers;
    public $languages;

    /**
     * Create a new component instance.
     */
    public function __construct($title = null, $subtitle = null, $action = null, $publishers = [], $languages = [] , $option = [])
    {
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->action = $action;
        $this->publishers = $publishers;
        $this->languages = $languages;
        $this->option = $option;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.article-search-form');
    }
}
