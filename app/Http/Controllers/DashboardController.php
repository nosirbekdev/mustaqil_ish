<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        // Qidiruv so'zi mavjudmi?
        $query = Article::query();

        if ($request->has('search') && $request->search != '') {
            $searchTerm = $request->search;
            // Qidiruv sarlavha va kontentga mos keladigan maqolalarni topadi
            $query->where('title', 'like', '%' . $searchTerm . '%')
                  ->orWhere('content', 'like', '%' . $searchTerm . '%');
        }

        if (auth()->user()->hasRole('admin')) {
            // Admin uchun barcha maqolalarni olish va sahifalash
            $articles = $query->paginate(6); // 6 ta maqolani har sahifada ko'rsatish
        } else {
            // Oddiy foydalanuvchi uchun faqat o'z maqolalarini olish va sahifalash
            $articles = $query->where('author_id', auth()->id())->paginate(6); // 6 ta maqolani har sahifada ko'rsatish
        }

        return view('dashboard', compact('articles'));
    }
}
