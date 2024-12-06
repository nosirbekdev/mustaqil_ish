<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Monograph;

class MonographController extends Controller
{
    // Monographni yaratish
    public function create()
    {
        return view('articles.create');
    }

    // Monographni saqlash
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

        // Monographni saqlash
        Monograph::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'image' => $imagePath,
            'pdf' => $pdfPath,
            'author_id' => auth()->id(),
            'author_type' => get_class(auth()->user()),
        ]);

        return redirect()->route('dashboard')->with('success', 'Monograph muvaffaqiyatli yaratildi va ko\'rib chiqilmoqda!');
    }

    // Monographni tasdiqlash
    public function approve($id)
    {
        $monograph = Monograph::findOrFail($id);

        // Tasdiqlash faqat admin uchun
        if (auth()->user()->hasRole('admin')) {
            $monograph->is_approved = true;
            $monograph->save();

            return redirect()->route('dashboard')->with('success', 'Monograph tasdiqlandi!');
        }

        return redirect()->route('dashboard')->with('error', 'Sizda bu amalni bajarishga ruxsat yo\'q.');
    }

    // Monographni ko'rsatish
    public function show($id)
    {
        $monograph = Monograph::findOrFail($id);
        return view('monographs.show', compact('monograph'));
    }

    // Monographni tahrirlash
    public function edit($id)
    {
        $monograph = Monograph::findOrFail($id);

        // Faqat o'z Monographni tahrirlash uchun ruxsat berish
        if (auth()->user()->id !== $monograph->author_id && !auth()->user()->hasRole('admin')) {
            return redirect()->route('dashboard')->with('error', 'Sizda bu Monographni tahrirlash huquqi yo\'q.');
        }

        return view('monographs.edit', compact('monograph'));
    }

    // Monographni yangilash
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $monograph = Monograph::findOrFail($id);

        if (auth()->user()->id !== $monograph->author_id && !auth()->user()->hasRole('admin')) {
            return redirect()->route('dashboard')->with('error', 'Sizda bu Monographni yangilash huquqi yo\'q.');
        }

        $monograph->update([
            'title' => $validated['title'],
            'content' => $validated['content'],
        ]);

        return redirect()->route('dashboard')->with('success', 'Monograph muvaffaqiyatli yangilandi!');
    }

    // Monographni o'chirish
    public function destroy($id)
    {
        $monograph = Monograph::findOrFail($id);

        if (auth()->user()->hasRole('admin') || auth()->user()->id === $monograph->author_id) {
            $monograph->delete();
            return redirect()->route('dashboard')->with('success', 'Monograph o\'chirildi.');
        }

        return redirect()->route('dashboard')->with('error', 'Siz bu Monographni o\'chirishingiz mumkin emas.');
    }
}
