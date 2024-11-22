@extends('layouts.app')

@section('content')
    <div class="max-w-2xl mx-auto p-6">
        <h1 class="text-3xl font-semibold text-center mb-6">Maqola Yaratish</h1>

        <div class="bg-white shadow-lg rounded-lg p-8">
            <form action="{{ route('articles.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="title" class="block text-sm font-medium text-gray-700">Sarlavha:</label>
                    <input type="text" name="title" id="title" class="w-full p-3 mt-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Maqola sarlavhasini kiriting" required>
                </div>

                <div class="mb-4">
                    <label for="content" class="block text-sm font-medium text-gray-700">Maqola matni:</label>
                    <textarea name="content" id="content" class="w-full p-3 mt-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Maqola matnini kiriting" required></textarea>
                </div>

                <button type="submit" class="w-full py-3 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition duration-300">Yuborish</button>
            </form>
        </div>
    </div>
@endsection
