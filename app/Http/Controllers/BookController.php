<?php
namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    // Kitoblar ro'yxati
    public function bookIndex()
    {
        $books = Book::latest()->paginate(10); // Kitoblar ro'yxatini olish
        return view('books.index', compact('books')); // Kitoblar ro'yxatini ko'rsatish
    }


    // Kitob qo'shish formasi
    public function create()
    {
        return view('books.create');
    }

    // Kitobni saqlash
    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'author' => 'required|string|max:255',
        'image' => 'nullable|image|max:2048',
        'pdf' => 'nullable|mimes:pdf|max:10240',
    ]);

    $bookData = $request->all();

    // Fayllarni saqlash
    if ($request->hasFile('image')) {
        $bookData['image'] = $request->file('image')->store('images', 'public');
    }

    if ($request->hasFile('pdf')) {
        $bookData['pdf'] = $request->file('pdf')->store('pdfs', 'public');
    }

    Book::create($bookData);

    return redirect()->route('books.index')->with('success', 'Kitob muvaffaqiyatli qo\'shildi.');
}




    // Kitobni ko'rish
    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    // Kitobni o'chirish
    public function destroy(Book $book)
    {
        // Agar kitobning rasmi bo'lsa, uni o'chirish
        if ($book->image) {
            Storage::disk('public')->delete($book->image);
        }

        // Agar kitobning PDF fayli bo'lsa, uni o'chirish
        if ($book->pdf) {
            Storage::disk('public')->delete($book->pdf);
        }

        // Kitobni o'chirish
        $book->delete();

        return redirect()->route('books.index')->with('success', 'Kitob o\'chirildi.');
    }

    public function edit(Book $book)
{
    return view('books.create', compact('book'));
}

public function update(Request $request, Book $book)
{
    $request->validate([
        'title' => 'required|string|max:255',
        'author' => 'required|string|max:255',
        'image' => 'nullable|image|max:2048',
        'pdf' => 'nullable|mimes:pdf|max:10240',
    ]);

    // Yangilash uchun ma'lumotlarni tayyorlash
    $data = $request->only(['title', 'author']);

    if ($request->hasFile('image')) {
        // Eski rasmni o'chirish
        if ($book->image) {
            Storage::disk('public')->delete($book->image);
        }
        // Yangi rasmni saqlash
        $data['image'] = $request->file('image')->store('images', 'public');
    }

    if ($request->hasFile('pdf')) {
        // Eski PDF'ni o'chirish
        if ($book->pdf) {
            Storage::disk('public')->delete($book->pdf);
        }
        // Yangi PDF'ni saqlash
        $data['pdf'] = $request->file('pdf')->store('pdfs', 'public');
    }

    $book->update($data);

    return redirect()->route('books.index')->with('success', 'Kitob muvaffaqiyatli yangilandi.');
}

}
