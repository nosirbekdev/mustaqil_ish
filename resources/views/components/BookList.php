<?php

namespace App\View\Components;

use Illuminate\View\Component;

class BookList extends Component
{
    public $books;

    /**
     * Create a new component instance.
     *
     * @param array $books
     */
    public function __construct($books)
    {
        $this->books = $books;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.book-list');
    }
}
