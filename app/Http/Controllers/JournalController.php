<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Journal;

class JournalController extends Controller
{
    // Journal yaratish
    public function create()
    {
        return view('articles.create');
    }

    // Journal saqlash
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

        // Journal saqlash
        Journal::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'image' => $imagePath,
            'pdf' => $pdfPath,
            'author_id' => auth()->id(),
            'author_type' => get_class(auth()->user()),
        ]);

        return redirect()->route('dashboard')->with('success', 'Journal muvaffaqiyatli yaratildi va ko\'rib chiqilmoqda!');
    }

    // Journal tasdiqlash
    public function approve($id)
    {
        $journal = Journal::findOrFail($id);

        // Tasdiqlash faqat admin uchun
        if (auth()->user()->hasRole('admin')) {
            $journal->is_approved = true;
            $journal->save();

            return redirect()->route('dashboard')->with('success', 'Journal tasdiqlandi!');
        }

        return redirect()->route('dashboard')->with('error', 'Sizda bu amalni bajarishga ruxsat yo\'q.');
    }

    // Journal ko'rsatish
    public function show($id)
    {
        $journal = Journal::findOrFail($id);
        return view('journal.show', compact('journal'));
    }

    // Journal tahrirlash
    public function edit($id)
    {
        $journal = Journal::findOrFail($id);

        // Faqat o'z Journalsini tahrirlash uchun ruxsat berish
        if (auth()->user()->id !== $journal->author_id && !auth()->user()->hasRole('admin')) {
            return redirect()->route('dashboard')->with('error', 'Sizda bu Journal tahrirlash huquqi yo\'q.');
        }

        return view('journals.edit', compact('journal'));
    }

    // Journal yangilash
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $journal = Journal::findOrFail($id);

        if (auth()->user()->id !== $journal->author_id && !auth()->user()->hasRole('admin')) {
            return redirect()->route('dashboard')->with('error', 'Sizda bu Journal yangilash huquqi yo\'q.');
        }

        $Journal->update([
            'title' => $validated['title'],
            'content' => $validated['content'],
        ]);

        return redirect()->route('dashboard')->with('success', 'Journal muvaffaqiyatli yangilandi!');
    }

    // Journal o'chirish
    public function destroy($id)
    {
        $journal = Journal::findOrFail($id);

        if (auth()->user()->hasRole('admin') || auth()->user()->id === $journal->author_id) {
            $journal->delete();
            return redirect()->route('dashboard')->with('success', 'Journal o\'chirildi.');
        }

        return redirect()->route('dashboard')->with('error', 'Siz bu Journal o\'chirishingiz mumkin emas.');
    }
}
