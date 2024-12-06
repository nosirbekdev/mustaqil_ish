@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    <h1 class="text-2xl font-semibold mb-4">{{ isset($book) ? 'Kitobni Tahrirlash' : 'Yangi Kitob Qo\'shish' }}</h1>

    <form action="{{ isset($book) ? route('books.update', $book->id) : route('books.store') }}"
          method="POST"
          enctype="multipart/form-data">
        @csrf
        @if(isset($book))
            @method('PUT')
        @endif

        <div class="mb-4">
            <label for="title" class="block text-sm font-medium">Kitob nomi</label>
            <input type="text" name="title" id="title"
                   value="{{ old('title', $book->title ?? '') }}"
                   class="w-full p-2 border border-gray-300 rounded-md" required>
        </div>

        <div class="mb-4">
            <label for="author" class="block text-sm font-medium">Muallif</label>
            <input type="text" name="author" id="author"
                   value="{{ old('author', $book->author ?? '') }}"
                   class="w-full p-2 border border-gray-300 rounded-md" required>
        </div>

        <div class="mb-4">
            <label for="image" class="block text-sm font-medium">Rasm</label>
            <input type="file" name="image" id="image"
                   class="w-full p-2 border border-gray-300 rounded-md">
            @if(isset($book) && $book->image)
                <img src="{{ asset('storage/' . $book->image) }}" alt="Book Image" class="w-24 h-32 mt-2">
            @endif
        </div>

        <div class="mb-4">
            <label for="pdf" class="block text-sm font-medium">PDF Fayl</label>
            <input type="file" name="pdf" id="pdf"
                   class="w-full p-2 border border-gray-300 rounded-md">
            @if(isset($book) && $book->pdf)
                <a href="{{ asset('storage/' . $book->pdf) }}" class="text-blue-500 mt-2 inline-block" target="_blank">Yuklangan PDF-ni ko'rish</a>
            @endif
        </div>

        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md">
            {{ isset($book) ? 'Yangilash' : 'Saqlash' }}
        </button>
    </form>
</div>
@endsection
