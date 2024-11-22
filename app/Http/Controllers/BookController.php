<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        // Get query parameters
        $publisher = $request->query('search_publisher');
        $language = $request->query('search_language');
        $keyword = $request->query('q');

        // Get all books
        $books = collect(config('books.books'));

        // Filter books based on the search parameters
        $filteredBooks = $books->filter(function ($book) use ($publisher, $language, $keyword) {
            return (!$publisher || $book['publisher'] === $publisher) &&
                   (!$language || $book['language'] === $language) &&
                   (!$keyword || stripos($book['title'], $keyword) !== false);
        });

        // Pass the filtered books to the view
        return view('search', ['books' => $filteredBooks]);
    }
}
