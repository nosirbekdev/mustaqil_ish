<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Europe;

class EuropeController extends Controller
{
    // Europe yaratish
    public function create()
    {
        return view('articles.create');
    }

    // Europe saqlash
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

        // Europe saqlash
        Europe::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'image' => $imagePath,
            'pdf' => $pdfPath,
            'author_id' => auth()->id(),
            'author_type' => get_class(auth()->user()),
        ]);

        return redirect()->route('dashboard')->with('success', 'Europe muvaffaqiyatli yaratildi va ko\'rib chiqilmoqda!');
    }

    // Europe tasdiqlash
    public function approve($id)
    {
        $europe = Europe::findOrFail($id);

        // Tasdiqlash faqat admin uchun
        if (auth()->user()->hasRole('admin')) {
            $europe->is_approved = true;
            $europe->save();

            return redirect()->route('dashboard')->with('success', 'Europe tasdiqlandi!');
        }

        return redirect()->route('dashboard')->with('error', 'Sizda bu amalni bajarishga ruxsat yo\'q.');
    }

    // Europe ko'rsatish
    public function show($id)
    {
        $europe = Europe::findOrFail($id);
        return view('europes.show', compact('europe'));
    }

    // Europe tahrirlash
    public function edit($id)
    {
        $europe = Europe::findOrFail($id);

        // Faqat o'z Europesini tahrirlash uchun ruxsat berish
        if (auth()->user()->id !== $europe->author_id && !auth()->user()->hasRole('admin')) {
            return redirect()->route('dashboard')->with('error', 'Sizda bu Europe tahrirlash huquqi yo\'q.');
        }

        return view('europes.edit', compact('europe'));
    }

    // Europe yangilash
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $europe = Europe::findOrFail($id);

        if (auth()->user()->id !== $europe->author_id && !auth()->user()->hasRole('admin')) {
            return redirect()->route('dashboard')->with('error', 'Sizda bu Europe yangilash huquqi yo\'q.');
        }

        $Europe->update([
            'title' => $validated['title'],
            'content' => $validated['content'],
        ]);

        return redirect()->route('dashboard')->with('success', 'Dissertatsiya muvaffaqiyatli yangilandi!');
    }

    // Europe o'chirish
    public function destroy($id)
    {
        $europe = Europe::findOrFail($id);

        if (auth()->user()->hasRole('admin') || auth()->user()->id === $europe->author_id) {
            $europe->delete();
            return redirect()->route('dashboard')->with('success', 'Europe o\'chirildi.');
        }

        return redirect()->route('dashboard')->with('error', 'Siz bu Europe o\'chirishingiz mumkin emas.');
    }
}
