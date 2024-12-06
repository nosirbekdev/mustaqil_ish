@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto p-6">
<p class="text-gray-600 text-md mb-2 overflow-hidden max-h-20 truncate">
                           Author: {{ $american->author->name }}
                        </p>
    <!-- Maqola yoki dissertatsiya sarlavhasi -->
    <h1 class="text-3xl font-semibold mb-4">{{ $american->title }}</h1>

    <!-- Maqola yoki dissertatsiya mazmuni -->
    <div class="text-gray-700 leading-relaxed whitespace-pre-line">
    @foreach (explode("\n", $american->content) as $paragraph)
        <p class="mb-4">{{ $paragraph }}</p>
    @endforeach
    </div>

    <!-- PDF fayl va rasm (agar mavjud bo'lsa) -->
    @if ($american->pdf)
        <a href="{{ asset('storage/' . $american->pdf) }}" class="text-blue-600 hover:underline mt-4 inline-block" target="_blank">PDF faylni ko'rish</a>
    @endif

    @if ($american->image)
        <div class="mt-4">
            <img src="{{ asset('storage/' . $american->image) }}" alt="Image" class="max-w-full h-auto rounded-md">
        </div>
    @endif

    <!-- Ortga qaytish tugmasi -->
    <div class="mt-4">
        <a href="{{ route('dashboard') }}" class="bg-gray-500 text-white px-4 py-2 rounded-md">Orqaga</a>
    </div>
</div>
@endsection
