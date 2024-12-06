<?php

namespace App\Http\Controllers;

use App\Models\Dissertation;
use Illuminate\Http\Request;

class DissertationController extends Controller
{
    // Dissertatsiyani yaratish
    public function create()
    {
        return view('articles.create');
    }

    // Dissertatsiyani saqlash
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

        // Dissertatsiyani saqlash
        Dissertation::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'image' => $imagePath,
            'pdf' => $pdfPath,
            'author_id' => auth()->id(),
            'author_type' => get_class(auth()->user()),
        ]);

        return redirect()->route('dashboard')->with('success', 'Dissertatsiya muvaffaqiyatli yaratildi va ko\'rib chiqilmoqda!');
    }

    // Dissertatsiyani tasdiqlash
    public function approve($id)
    {
        $dissertation = Dissertation::findOrFail($id);

        // Tasdiqlash faqat admin uchun
        if (auth()->user()->hasRole('admin')) {
            $dissertation->is_approved = true;
            $dissertation->save();

            return redirect()->route('dashboard')->with('success', 'Dissertatsiya tasdiqlandi!');
        }

        return redirect()->route('dashboard')->with('error', 'Sizda bu amalni bajarishga ruxsat yo\'q.');
    }

    // Dissertatsiyani ko'rsatish
    public function show($id)
    {
        $dissertation = Dissertation::findOrFail($id);
        return view('dissertations.show', compact('dissertation'));
    }

    // Dissertatsiyani tahrirlash
    public function edit($id)
    {
        $dissertation = Dissertation::findOrFail($id);

        // Faqat o'z dissertatsiyasini tahrirlash uchun ruxsat berish
        if (auth()->user()->id !== $dissertation->author_id && !auth()->user()->hasRole('admin')) {
            return redirect()->route('dashboard')->with('error', 'Sizda bu dissertatsiyani tahrirlash huquqi yo\'q.');
        }

        return view('dissertations.edit', compact('dissertation'));
    }

    // Dissertatsiyani yangilash
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $dissertation = Dissertation::findOrFail($id);

        if (auth()->user()->id !== $dissertation->author_id && !auth()->user()->hasRole('admin')) {
            return redirect()->route('dashboard')->with('error', 'Sizda bu dissertatsiyani yangilash huquqi yo\'q.');
        }

        $dissertation->update([
            'title' => $validated['title'],
            'content' => $validated['content'],
        ]);

        return redirect()->route('dashboard')->with('success', 'Dissertatsiya muvaffaqiyatli yangilandi!');
    }

    // Dissertatsiyani o'chirish
    public function destroy($id)
    {
        $dissertation = Dissertation::findOrFail($id);

        if (auth()->user()->hasRole('admin') || auth()->user()->id === $dissertation->author_id) {
            $dissertation->delete();
            return redirect()->route('dashboard')->with('success', 'Dissertatsiya o\'chirildi.');
        }

        return redirect()->route('dashboard')->with('error', 'Siz bu dissertatsiyani o\'chirishingiz mumkin emas.');
    }
}
