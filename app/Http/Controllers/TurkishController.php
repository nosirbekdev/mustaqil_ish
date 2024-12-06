<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Turkish;

class TurkishController extends Controller
{
    // turkish yaratish
    public function create()
    {
        return view('articles.create');
    }

    // turkish saqlash
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

        // turkish saqlash
        Turkish::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'image' => $imagePath,
            'pdf' => $pdfPath,
            'author_id' => auth()->id(),
            'author_type' => get_class(auth()->user()),
        ]);

        return redirect()->route('dashboard')->with('success', 'Turkish muvaffaqiyatli yaratildi va ko\'rib chiqilmoqda!');
    }

    // turkish tasdiqlash
    public function approve($id)
    {
        $turkish = Turkish::findOrFail($id);

        // Tasdiqlash faqat admin uchun
        if (auth()->user()->hasRole('admin')) {
            $turkish->is_approved = true;
            $turkish->save();

            return redirect()->route('dashboard')->with('success', 'Turkish tasdiqlandi!');
        }

        return redirect()->route('dashboard')->with('error', 'Sizda bu amalni bajarishga ruxsat yo\'q.');
    }

    // turkish ko'rsatish
    public function show($id)
    {
        $turkish = Turkish::findOrFail($id);
        return view('turkishs.show', compact('turkish'));
    }

    // turkish tahrirlash
    public function edit($id)
    {
        $turkish = Turkish::findOrFail($id);

        // Faqat o'z turkishsini tahrirlash uchun ruxsat berish
        if (auth()->user()->id !== $turkish->author_id && !auth()->user()->hasRole('admin')) {
            return redirect()->route('dashboard')->with('error', 'Sizda bu turkish tahrirlash huquqi yo\'q.');
        }

        return view('turkishs.edit', compact('turkish'));
    }

    // turkish yangilash
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $turkish = Turkish::findOrFail($id);

        if (auth()->user()->id !== $turkish->author_id && !auth()->user()->hasRole('admin')) {
            return redirect()->route('dashboard')->with('error', 'Sizda bu turkish yangilash huquqi yo\'q.');
        }

        $turkish->update([
            'title' => $validated['title'],
            'content' => $validated['content'],
        ]);

        return redirect()->route('dashboard')->with('success', 'Dissertatsiya muvaffaqiyatli yangilandi!');
    }

    // turkish o'chirish
    public function destroy($id)
    {
        $turkish = Turkish::findOrFail($id);

        if (auth()->user()->hasRole('admin') || auth()->user()->id === $turkish->author_id) {
            $turkish->delete();
            return redirect()->route('dashboard')->with('success', 'turkish o\'chirildi.');
        }

        return redirect()->route('dashboard')->with('error', 'Siz bu turkish o\'chirishingiz mumkin emas.');
    }
}
