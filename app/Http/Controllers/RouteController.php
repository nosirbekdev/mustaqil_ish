<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view('user.about.books');
    }
    public function articles() {
        return view('user.about.articles');
    }

    // scientific
    public function dissertations() {
        return view('user.scientific.dissertations');
    }
    public function abstracts() {
        return view('user.scientific.abstracts');
    }
    public function monographs() {
        return view('user.scientific.monographs');
    }
    public function articlesScientific() {
        return view('user.scientific.articles');
    }

    // magamagazines
    public function yevropa() {
        return view('user.magazines.yevropa');
    }
    public function turkiya() {
        return view('user.magazines.turkiya');
    }
    public function russia() {
        return view('user.magazines.russia');
    }
    public function amerika() {
        return view('user.magazines.amerika');
    }
    public function centralasia() {
        return view('user.magazines.centralasia');
    }

    // literature
    public function textbooks() {
        return view('user.literature.textbooks');
    }
    public function manuals() {
        return view('user.literature.manuals');
    }

    // galereya
    public function photos() {
        return view('user.gallery.photos');
    }

    public function journal() {
        return view('journal');
    }

    public function contact() {
        return view('contact');
    }
}
