<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Russia;

class RussiaController extends Controller
{
    // Russia yaratish
    public function create()
    {
        return view('articles.create');
    }

    // Russia saqlash
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

        // Russia saqlash
        Russia::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'image' => $imagePath,
            'pdf' => $pdfPath,
            'author_id' => auth()->id(),
            'author_type' => get_class(auth()->user()),
        ]);

        return redirect()->route('dashboard')->with('success', 'Russia muvaffaqiyatli yaratildi va ko\'rib chiqilmoqda!');
    }

    // Russia tasdiqlash
    public function approve($id)
    {
        $russia = Russia::findOrFail($id);

        // Tasdiqlash faqat admin uchun
        if (auth()->user()->hasRole('admin')) {
            $russia->is_approved = true;
            $russia->save();

            return redirect()->route('dashboard')->with('success', 'Russia tasdiqlandi!');
        }

        return redirect()->route('dashboard')->with('error', 'Sizda bu amalni bajarishga ruxsat yo\'q.');
    }

    // Russia ko'rsatish
    public function show($id)
    {
        $russia = Russia::findOrFail($id);
        return view('russia.show', compact('russia'));
    }

    // Russia tahrirlash
    public function edit($id)
    {
        $russia = Russia::findOrFail($id);

        // Faqat o'z Russiasini tahrirlash uchun ruxsat berish
        if (auth()->user()->id !== $russia->author_id && !auth()->user()->hasRole('admin')) {
            return redirect()->route('dashboard')->with('error', 'Sizda bu Russia tahrirlash huquqi yo\'q.');
        }

        return view('russia.edit', compact('russia'));
    }

    // Russia yangilash
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $russia = Russia::findOrFail($id);

        if (auth()->user()->id !== $russia->author_id && !auth()->user()->hasRole('admin')) {
            return redirect()->route('dashboard')->with('error', 'Sizda bu Russia yangilash huquqi yo\'q.');
        }

        $russia->update([
            'title' => $validated['title'],
            'content' => $validated['content'],
        ]);

        return redirect()->route('dashboard')->with('success', 'Dissertatsiya muvaffaqiyatli yangilandi!');
    }

    // Russia o'chirish
    public function destroy($id)
    {
        $russia = Russia::findOrFail($id);

        if (auth()->user()->hasRole('admin') || auth()->user()->id === $russia->author_id) {
            $russia->delete();
            return redirect()->route('dashboard')->with('success', 'Russia o\'chirildi.');
        }

        return redirect()->route('dashboard')->with('error', 'Siz bu Russia o\'chirishingiz mumkin emas.');
    }
}
