@extends('layouts.app')

@section('title', 'Fotolavha')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-semibold text-center mb-6">Fotolavha</h1>
    <div class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-lg">
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-800">{{ $photo->title }}</h2>
        </div>

        <div class="mb-6">
            <img src="{{ asset('storage/' . $photo->image) }}" alt="{{ $photo->title }}" class="w-full h-auto rounded-lg shadow-md">
        </div>

        <div class="flex justify-between">
            <a href="{{ route('photos.edit', $photo) }}" class="bg-blue-500 text-white py-2 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400">
                Tahrirlash
            </a>
            <form action="{{ route('photos.destroy', $photo) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded-md hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-400">
                    O'chirish
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
