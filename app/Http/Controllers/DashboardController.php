<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Dissertation;
use App\Models\Avtoreferat as AvtoreferatModel;
use App\Models\Monograph;
use App\Models\Europe;
use App\Models\American;
use App\Models\Turkish;
use App\Models\Russia;
use App\Models\Asia;
use App\Models\Journal;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Qidiruv so'zi mavjudmi?
        $queryArticles = Article::query();
        $queryDissertations = Dissertation::query();
        $queryAbstracts = AvtoreferatModel::query();
        $queryMonographs = Monograph::query();
        $queryEurope = Europe::query();
        $queryAmerican = American::query();
        $queryTurkish = Turkish::query();
        $queryRussia = Russia::query();
        $queryAsia = Asia::query();
        $queryJournal = Journal::query();

        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;
            // Maqolalar uchun qidiruv
            $queryArticles->where('title', 'like', '%' . $searchTerm . '%')
                          ->orWhere('content', 'like', '%' . $searchTerm . '%');
            // Dissertatsiyalar uchun qidiruv
            $queryDissertations->where('title', 'like', '%' . $searchTerm . '%')
                               ->orWhere('content', 'like', '%' . $searchTerm . '%');
            // Avtoreferatlar uchun qidiruv
            $queryAbstracts->where('title', 'like', '%' . $searchTerm . '%')
                           ->orWhere('content', 'like', '%' . $searchTerm . '%');
            // Monografiyalar uchun qidiruv
            $queryMonographs->where('title', 'like', '%' . $searchTerm . '%')
                            ->orWhere('content', 'like', '%' . $searchTerm . '%');
            // Yevropa uchun qidiruv
            $queryEurope->where('title', 'like', '%' . $searchTerm . '%')
                            ->orWhere('content', 'like', '%' . $searchTerm . '%');
            // Amerika uchun qidiruv
            $queryAmerican->where('title', 'like', '%' . $searchTerm . '%')
                            ->orWhere('content', 'like', '%' . $searchTerm . '%');
            // Turkiya uchun qidiruv
            $queryTurkish->where('title', 'like', '%' . $searchTerm . '%')
                            ->orWhere('content', 'like', '%' . $searchTerm . '%');
            // Rossiya uchun qidiruv
            $queryRussia->where('title', 'like', '%' . $searchTerm . '%')
                            ->orWhere('content', 'like', '%' . $searchTerm . '%');
            // Markaziy osio uchun qidiruv
            $queryAsia->where('title', 'like', '%' . $searchTerm . '%')
                            ->orWhere('content', 'like', '%' . $searchTerm . '%');
            // Jurnallar uchun qidiruv
            $queryJournal->where('title', 'like', '%' . $searchTerm . '%')
                            ->orWhere('content', 'like', '%' . $searchTerm . '%');
        }

        // Admin uchun maqolalar va dissertatsiyalarni olish va sahifalash
        if (auth()->user()->hasRole('admin')) {
            $articles = $queryArticles->paginate(6);
            $dissertations = $queryDissertations->paginate(6);
            $abstracts = $queryAbstracts->paginate(6);
            $monographs = $queryMonographs->paginate(6);
            $europes = $queryEurope->paginate(6);
            $americans = $queryAmerican->paginate(6);
            $turkishes = $queryTurkish->paginate(6);
            $russias = $queryRussia->paginate(6);
            $asias = $queryAsia->paginate(6);
            $journals = $queryJournal->paginate(6);
        } else {
            // Oddiy foydalanuvchi uchun faqat o'z maqolalari va dissertatsiyalarini olish va sahifalash
            $articles = $queryArticles->where('author_id', auth()->id())->paginate(6);
            $dissertations = $queryDissertations->where('author_id', auth()->id())->paginate(6);
            $abstracts = $queryAbstracts->where('author_id', auth()->id())->paginate(6);
            $monographs = $queryMonographs->where('author_id', auth()->id())->paginate(6);
            $europes = $queryEurope->where('author_id', auth()->id())->paginate(6);
            $americans = $queryAmerican->where('author_id', auth()->id())->paginate(6);
            $turkishes = $queryTurkish->where('author_id', auth()->id())->paginate(6);
            $russias = $queryRussia->where('author_id', auth()->id())->paginate(6);
            $asias = $queryAsia->where('author_id', auth()->id())->paginate(6);
            $journals = $queryJournal->where('author_id', auth()->id())->paginate(6);
        }

        return view('dashboard', compact('articles', 'dissertations', 'abstracts', 'monographs', 'europes', 'americans', 'turkishes', 'russias', 'asias', 'journals'));
    }
}
