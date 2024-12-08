@extends('layouts.app')

@section('title', 'Fotolavha Qo\'shish')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-semibold text-center mb-6">Fotolavha Qo'shish</h1>
    <form action="{{ route('photos.store') }}" method="POST" enctype="multipart/form-data" class="max-w-lg mx-auto bg-white p-6 rounded-lg shadow-lg">
        @csrf
        <div class="mb-4">
            <label for="title" class="block text-lg font-medium text-gray-700">Sarlavha</label>
            <input type="text" name="title" id="title" class="mt-2 p-3 border border-gray-300 rounded-md w-full focus:ring-blue-500 focus:border-blue-500" required>
        </div>
        <div class="mb-4">
            <label for="image" class="block text-lg font-medium text-gray-700">Rasm</label>
            <input type="file" name="image" id="image" class="mt-2 p-3 border border-gray-300 rounded-md w-full text-gray-700 file:border-0 file:bg-blue-100 file:text-blue-700 hover:file:bg-blue-200 focus:ring-blue-500 focus:border-blue-500" required>
        </div>
        <button type="submit" class="w-full bg-green-500 text-white py-3 px-4 rounded-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-400">
            Saqlash
        </button>
    </form>
</div>
@endsection
