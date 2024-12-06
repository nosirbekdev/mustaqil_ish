<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\American;

class AmericanController extends Controller
{
    // American yaratish
    public function create()
    {
        return view('articles.create');
    }

    // American saqlash
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

        // American saqlash
        American::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'image' => $imagePath,
            'pdf' => $pdfPath,
            'author_id' => auth()->id(),
            'author_type' => get_class(auth()->user()),
        ]);

        return redirect()->route('dashboard')->with('success', 'American muvaffaqiyatli yaratildi va ko\'rib chiqilmoqda!');
    }

    // American tasdiqlash
    public function approve($id)
    {
        $american = American::findOrFail($id);

        // Tasdiqlash faqat admin uchun
        if (auth()->user()->hasRole('admin')) {
            $american->is_approved = true;
            $american->save();

            return redirect()->route('dashboard')->with('success', 'American tasdiqlandi!');
        }

        return redirect()->route('dashboard')->with('error', 'Sizda bu amalni bajarishga ruxsat yo\'q.');
    }

    // American ko'rsatish
    public function show($id)
    {
        $american = American::findOrFail($id);
        return view('americans.show', compact('american'));
    }

    // American tahrirlash
    public function edit($id)
    {
        $american = American::findOrFail($id);

        // Faqat o'z Americansini tahrirlash uchun ruxsat berish
        if (auth()->user()->id !== $american->author_id && !auth()->user()->hasRole('admin')) {
            return redirect()->route('dashboard')->with('error', 'Sizda bu American tahrirlash huquqi yo\'q.');
        }

        return view('americans.edit', compact('american'));
    }

    // American yangilash
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $american = American::findOrFail($id);

        if (auth()->user()->id !== $american->author_id && !auth()->user()->hasRole('admin')) {
            return redirect()->route('dashboard')->with('error', 'Sizda bu American yangilash huquqi yo\'q.');
        }

        $American->update([
            'title' => $validated['title'],
            'content' => $validated['content'],
        ]);

        return redirect()->route('dashboard')->with('success', 'Dissertatsiya muvaffaqiyatli yangilandi!');
    }

    // American o'chirish
    public function destroy($id)
    {
        $american = American::findOrFail($id);

        if (auth()->user()->hasRole('admin') || auth()->user()->id === $american->author_id) {
            $american->delete();
            return redirect()->route('dashboard')->with('success', 'American o\'chirildi.');
        }

        return redirect()->route('dashboard')->with('error', 'Siz bu American o\'chirishingiz mumkin emas.');
    }
}
