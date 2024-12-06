<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asia;

class AsiaController extends Controller
{
    // Asia yaratish
    public function create()
    {
        return view('articles.create');
    }

    // Asia saqlash
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

        // Asia saqlash
        Asia::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'image' => $imagePath,
            'pdf' => $pdfPath,
            'author_id' => auth()->id(),
            'author_type' => get_class(auth()->user()),
        ]);

        return redirect()->route('dashboard')->with('success', 'Asia muvaffaqiyatli yaratildi va ko\'rib chiqilmoqda!');
    }

    // asia tasdiqlash
    public function approve($id)
    {
        $asia = Asia::findOrFail($id);

        // Tasdiqlash faqat admin uchun
        if (auth()->user()->hasRole('admin')) {
            $asia->is_approved = true;
            $asia->save();

            return redirect()->route('dashboard')->with('success', 'Asia tasdiqlandi!');
        }

        return redirect()->route('dashboard')->with('error', 'Sizda bu amalni bajarishga ruxsat yo\'q.');
    }

    // asia ko'rsatish
    public function show($id)
    {
        $asia = Asia::findOrFail($id);
        return view('asia.show', compact('asia'));
    }

    // asia tahrirlash
    public function edit($id)
    {
        $asia = Asia::findOrFail($id);

        // Faqat o'z asiasini tahrirlash uchun ruxsat berish
        if (auth()->user()->id !== $asia->author_id && !auth()->user()->hasRole('admin')) {
            return redirect()->route('dashboard')->with('error', 'Sizda bu asia tahrirlash huquqi yo\'q.');
        }

        return view('asia.edit', compact('asia'));
    }

    // asia yangilash
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $asia = Asia::findOrFail($id);

        if (auth()->user()->id !== $asia->author_id && !auth()->user()->hasRole('admin')) {
            return redirect()->route('dashboard')->with('error', 'Sizda bu asia yangilash huquqi yo\'q.');
        }

        $asia->update([
            'title' => $validated['title'],
            'content' => $validated['content'],
        ]);

        return redirect()->route('dashboard')->with('success', 'Dissertatsiya muvaffaqiyatli yangilandi!');
    }

    // asia o'chirish
    public function destroy($id)
    {
        $asia = Asia::findOrFail($id);

        if (auth()->user()->hasRole('admin') || auth()->user()->id === $asia->author_id) {
            $asia->delete();
            return redirect()->route('dashboard')->with('success', 'asia o\'chirildi.');
        }

        return redirect()->route('dashboard')->with('error', 'Siz bu asia o\'chirishingiz mumkin emas.');
    }
}
