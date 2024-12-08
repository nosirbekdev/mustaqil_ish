@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-2xl font-bold mb-4">Yangi Video Qo'shish</h1>

        <form action="{{ route('videos.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="title" class="block text-sm font-semibold text-gray-600">Video Sarlavhasi</label>
                <input type="text" name="title" id="title" class="w-full px-4 py-2 border rounded" required>
            </div>
            <div class="mb-4">
                <label for="youtube_link" class="block text-sm font-semibold text-gray-600">YouTube Link</label>
                <input type="url" name="youtube_link" id="youtube_link" class="w-full px-4 py-2 border rounded" required>
            </div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md">Saqlash</button>
        </form>
    </div>
@endsection
