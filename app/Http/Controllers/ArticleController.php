<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    // Maqolani yaratish uchun forma ko'rsatish
    public function create()
    {
        return view('articles.create');
    }

    // Maqolani saqlash
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        Article::create([
            'title' => $request->title,
            'content' => $request->content,
            'is_approved' => false,
            'author_id' => auth()->id(),
            'author_type' => get_class(auth()->user()),
        ]);

        return redirect()->route('dashboard')->with('success', 'Maqola muvaffaqiyatli yaratildi va ko\'rib chiqilmoqda!');
    }

    // Maqolani tasdiqlash
    public function approve($id)
    {
        $article = Article::findOrFail($id);

        // Tasdiqlash faqat admin uchun
        if (auth()->user()->hasRole('admin')) {
            $article->is_approved = true;
            $article->save();

            return redirect()->route('dashboard')->with('success', 'Maqola tasdiqlandi!');
        }

        return redirect()->route('dashboard')->with('error', 'Sizda bu amalni bajarishga ruxsat yo\'q.');
    }

    public function show($id)
{
    $article = Article::findOrFail($id);
    return view('articles.show', compact('article'));
}


    public function edit($id)
    {
        $article = Article::findOrFail($id);

        // Faqat o'z maqolasini tahrirlash uchun ruxsat berish
        if (auth()->user()->id !== $article->author_id && !auth()->user()->hasRole('admin')) {
            return redirect()->route('dashboard')->with('error', 'Sizda bu maqolani tahrirlash huquqi yo\'q.');
        }

        return view('articles.edit', compact('article'));
    }

    public function update(Request $request, $id)
    {
        // Ma'lumotlarni validatsiya qilish
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $article = Article::findOrFail($id);

        // Faqat o'z maqolasini yangilash uchun ruxsat berish
        if (auth()->user()->id !== $article->author_id && !auth()->user()->hasRole('admin')) {
            return redirect()->route('dashboard')->with('error', 'Sizda bu maqolani yangilash huquqi yo\'q.');
        }


        // Maqolani yangilash
        $article->update([
            'title' => $validated['title'],
            'content' => $validated['content'],
        ]);

        return redirect()->route('dashboard')->with('success', 'Maqola muvaffaqiyatli yangilandi!');
    }

    public function destroy($id)
{
    // Maqolani topish
    $article = Article::findOrFail($id);

    // Maqola egasini olish (polimorfik aloqada)
    $author = $article->author;

    // Foydalanuvchi maqolani o'chirish huquqiga ega bo'lsa
    if (auth()->user()->hasRole('admin') || auth()->user()->id === $author->id) {
        // Maqolani o'chirish
        $article->delete();

        return redirect()->route('dashboard')->with('success', 'Maqola o\'chirildi.');
    }

    // Foydalanuvchi maqolani o'chirishga huquqi yo'q
    return redirect()->route('dashboard')->with('error', 'Siz bu maqolani o\'chirishingiz mumkin emas.');
}

}
