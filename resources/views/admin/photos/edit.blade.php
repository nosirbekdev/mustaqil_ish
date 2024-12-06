@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-semibold text-center mb-6">Fotolavhani Tahrirlash</h1>
    <form action="{{ route('photos.update', $photo) }}" method="POST" enctype="multipart/form-data" class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-lg">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="title" class="block text-lg font-medium text-gray-700">Sarlavha</label>
            <input type="text" name="title" id="title" value="{{ $photo->title }}" class="mt-2 p-3 border border-gray-300 rounded-md w-full focus:ring-blue-500 focus:border-blue-500" required>
        </div>

        <div class="mb-4">
            <label for="image" class="block text-lg font-medium text-gray-700">Rasm (agar yangilash kerak bo'lsa)</label>
            <input type="file" name="image" id="image" class="mt-2 p-3 border border-gray-300 rounded-md w-full text-gray-700 file:border-0 file:bg-blue-100 file:text-blue-700 hover:file:bg-blue-200 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <button type="submit" class="w-full bg-blue-500 text-white py-3 px-4 rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400">
            Yangilash
        </button>
    </form>
</div>
@endsection
