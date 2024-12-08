<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;
use App\Models\Book;
use App\Models\Dissertation;
use App\Models\Avtoreferat as AvtoreferatModel;
use App\Models\Monograph;
use App\Models\Europe;
use App\Models\American;
use App\Models\Turkish;
use App\Models\Russia;
use App\Models\Asia;
use App\Models\Photo;
use App\Models\Journal;
use App\Models\Video;

class RouteController extends Controller
{
    public function goals()
    {
        return view('user.about.goals');
    }

    public function participants()
    {
        return view('user.about.participants');
    }

    public function books()
    {
        $books = Book::all();
        // searching book
        if (request()->query('search')) {
            $books = Book::where('title', 'like', '%' . request()->query('search') . '%')->get();
        }

        return view('user.about.books', compact('books'));
    }
    public function articles() {
        $articles = Article::where('is_approved', true)->get();
        return view('user.about.articles', compact('articles'));
    }

    // scientific
    public function dissertations() {
        $dissertations = Dissertation::where('is_approved', true)->get();
        return view('user.scientific.dissertations', compact('dissertations'));
    }
    public function abstracts() {
        $abstracts = AvtoreferatModel::where('is_approved', true)->get();
        return view('user.scientific.abstracts', compact('abstracts'));
    }
    public function monographs() {
        $monographs = Monograph::where('is_approved', true)->get();
        return view('user.scientific.monographs', compact('monographs'));
    }
    public function articlesScientific() {
        $articles = Article::where('is_approved', true)->get();
        return view('user.scientific.articles', compact('articles'));
    }



    // magamagazines
    public function yevropa() {
        $europes = Europe::where('is_approved', true)->get();
        return view('user.magazines.yevropa', compact('europes'));
    }
    public function turkiya() {
        $turkishes = Turkish::where('is_approved', true)->get();
        return view('user.magazines.turkiya', compact('turkishes'));
    }
    public function russia() {
        $russias = Russia::where('is_approved', true)->get();
        return view('user.magazines.russia', compact('russias'));
    }
    public function amerika() {
        $americans = American::where('is_approved', true)->get();
        return view('user.magazines.amerika', compact('americans'));
    }
    public function centralasia() {
        $asias = Asia::where('is_approved', true)->get();
        return view('user.magazines.centralasia', compact('asias'));
    }

    // literature
    public function textbooks() {
        $books = Book::all();
        return view('user.literature.textbooks', compact('books'));
    }
    public function manuals() {
        $books = Book::all();
        return view('user.literature.manuals', compact('books'));
    }

    // galereya
    public function photos() {
        $photos = Photo::all();
        return view('user.gallery.photos', compact('photos'));
    }

    public function videos() {
        $videos = Video::all();
        return view('user.gallery.videos', compact('videos'));
        }

    public function journal() {
        $journals = Journal::where('is_approved', true)->get();
        return view('journal', compact('journals'));
    }

    public function contact() {
        return view('contact');
    }

    // books
    public function bookIndex() {
        return view('books.index');
    }

    public function photoIndex() {
        return view('admin.photos.index');
    }
}
