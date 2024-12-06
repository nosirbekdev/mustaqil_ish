<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Avtoreferat as AvtoreferatModel;

class AvtoreferatController extends Controller
{
    // Avtoreferatni yaratish
    public function create()
    {
        return view('abstracts.create');
    }

    // Avtoreferatni saqlash
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

        // Avtoreferatni saqlash
        AvtoreferatModel::create([
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

    // Avtoreferatni tasdiqlash
    public function approve($id)
    {
        $abstract = AvtoreferatModel::findOrFail($id);

        // Tasdiqlash faqat admin uchun
        if (auth()->user()->hasRole('admin')) {
            $abstract->is_approved = true;
            $abstract->save();

            return redirect()->route('dashboard')->with('success', 'Maqola tasdiqlandi!');
        }

        return redirect()->route('dashboard')->with('error', 'Sizda bu amalni bajarishga ruxsat yo\'q.');
    }

    // Avtoreferatni ko'rsatish
    public function show($id)
    {
        $abstract = AvtoreferatModel::findOrFail($id);
        return view('abstracts.show', compact('abstract'));
    }

    // Avtoreferatni tahrirlash
    public function edit($id)
    {
        $abstract = AvtoreferatModel::findOrFail($id);

        // Faqat o'z maqolasini tahrirlash uchun ruxsat berish
        if (auth()->user()->id !== $abstract->author_id && !auth()->user()->hasRole('admin')) {
            return redirect()->route('dashboard')->with('error', 'Sizda bu avtoreferatni tahrirlash huquqi yo\'q.');
        }

        return view('abstracts.edit', compact('abstract'));
    }

    // Avtoreferatni yangilash
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $abstract = AvtoreferatModel::findOrFail($id);

        if (auth()->user()->id !== $abstract->author_id && !auth()->user()->hasRole('admin')) {
            return redirect()->route('dashboard')->with('error', 'Sizda bu avtoreferatni yangilash huquqi yo\'q.');
        }

        $abstract->update([
            'title' => $validated['title'],
            'content' => $validated['content'],
        ]);

        return redirect()->route('dashboard')->with('success', 'Maqola muvaffaqiyatli yangilandi!');
    }

    // Avtoreferatni o'chirish
    public function destroy($id)
    {
        $abstract = AvtoreferatModel::findOrFail($id);

        if (auth()->user()->hasRole('admin') || auth()->user()->id === $abstract->author_id) {
            $abstract->delete();
            return redirect()->route('dashboard')->with('success', 'Maqola o\'chirildi.');
        }

        return redirect()->route('dashboard')->with('error', 'Siz bu avtoreferatni o\'chirishingiz mumkin emas.');
    }
}
