@extends('layouts.app')

@section('title', $book->title)

@section('content')
<div class="max-w-4xl mx-auto">

    <h1 class="text-2xl font-semibold mb-4">{{ $book->title }}</h1>

    <p class="text-lg">Muallif: <strong>{{ $book->author }}</strong></p>

    @if ($book->image)
        <div class="my-4">
            <img src="{{ asset('storage/' . $book->image) }}" alt="Book Image" class="w-64 h-96 object-cover">
        </div>
    @endif

    @if ($book->pdf)
        <div class="my-4">
            <a href="{{ asset('storage/' . $book->pdf) }}" class="text-blue-600 hover:underline" target="_blank">
                PDF faylni yuklab olish
            </a>
        </div>
    @endif

    <div class="mt-4">
        <a href="{{ route('books.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md">Orqaga</a>
    </div>
</div>
@endsection
