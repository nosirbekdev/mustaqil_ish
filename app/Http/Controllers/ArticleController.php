<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    // Maqolani yaratish
    public function create()
    {
        return view('articles.create');
    }

    // Maqolani saqlash
    public function store(Request $request)
    {
        // Ma'lumotlarni validatsiya qilish
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|max:2048',
            'pdf' => 'nullable|mimes:pdf|max:10000',
        ]);

        // Fayllarni saqlash
        $imagePath = null;
        $pdfPath = null;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        }

        if ($request->hasFile('pdf')) {
            $pdfPath = $request->file('pdf')->store('pdfs', 'public');
        }

        // Maqolani saqlash
        Article::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'image' => $imagePath,
            'pdf' => $pdfPath,
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

    // Maqolani ko'rsatish
    public function show($id)
    {
        $article = Article::findOrFail($id);
        return view('articles.show', compact('article'));
    }

    // Maqolani tahrirlash
    public function edit($id)
    {
        $article = Article::findOrFail($id);

        // Faqat o'z maqolasini tahrirlash uchun ruxsat berish
        if (auth()->user()->id !== $article->author_id && !auth()->user()->hasRole('admin')) {
            return redirect()->route('dashboard')->with('error', 'Sizda bu maqolani tahrirlash huquqi yo\'q.');
        }

        return view('articles.edit', compact('article'));
    }

    // Maqolani yangilash
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $article = Article::findOrFail($id);

        if (auth()->user()->id !== $article->author_id && !auth()->user()->hasRole('admin')) {
            return redirect()->route('dashboard')->with('error', 'Sizda bu maqolani yangilash huquqi yo\'q.');
        }

        $article->update([
            'title' => $validated['title'],
            'content' => $validated['content'],
        ]);

        return redirect()->route('dashboard')->with('success', 'Maqola muvaffaqiyatli yangilandi!');
    }

    // Maqolani o'chirish
    public function destroy($id)
    {
        $article = Article::findOrFail($id);

        if (auth()->user()->hasRole('admin') || auth()->user()->id === $article->author_id) {
            $article->delete();
            return redirect()->route('dashboard')->with('success', 'Maqola o\'chirildi.');
        }

        return redirect()->route('dashboard')->with('error', 'Siz bu maqolani o\'chirishingiz mumkin emas.');
    }
}
