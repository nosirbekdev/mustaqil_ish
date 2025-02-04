@extends('layouts.app')

@section('title', $journal->title)

@section('content')
<div class="max-w-2xl mx-auto p-6">
<p class="text-gray-600 text-md mb-2 overflow-hidden max-h-20 truncate">
                           Author: {{ $journal->author->name }}
                        </p>
    <!-- Maqola yoki dissertatsiya sarlavhasi -->
    <h1 class="text-3xl font-semibold mb-4">{{ $journal->title }}</h1>

    <!-- Maqola yoki dissertatsiya mazmuni -->
    <div class="text-gray-700 leading-relaxed whitespace-pre-line">
    @foreach (explode("\n", $journal->content) as $paragraph)
        <p class="mb-4">{{ $paragraph }}</p>
    @endforeach
    </div>

    <!-- PDF fayl va rasm (agar mavjud bo'lsa) -->
    @if ($journal->pdf)
        <a href="{{ asset('storage/' . $journal->pdf) }}" class="text-blue-600 hover:underline mt-4 inline-block" target="_blank">PDF faylni ko'rish</a>
    @endif

    @if ($journal->image)
        <div class="mt-4">
            <img src="{{ asset('storage/' . $journal->image) }}" alt="Image" class="max-w-full h-auto rounded-md">
        </div>
    @endif

    <!-- Ortga qaytish tugmasi -->
    <div class="mt-4">
        <a href="{{ route('dashboard') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md">Orqaga</a>
    </div>
</div>
@endsection
