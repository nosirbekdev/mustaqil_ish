@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto p-6">
    <!-- Maqola sarlavhasi -->
    <h1 class="text-3xl font-semibold mb-4">{{ $article->title }}</h1>

    <!-- Maqola mazmuni -->
    <div class="text-gray-700 leading-relaxed whitespace-pre-line">
    @foreach (explode("\n", $article->content) as $paragraph)
        <p class="mb-4">{{ $paragraph }}</p>
    @endforeach
</div>


    <!-- Ortga qaytish tugmasi -->
    <a href="{{ route('dashboard') }}" class="text-blue-600 hover:underline mt-6 inline-block">Ortga</a>
</div>
@endsection
