@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="flex justify-between items-center">
        <h1 class="text-2xl font-bold mb-4">Videolar</h1>
        <a href="{{ route('videos.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">Yangi Video Qo'shish</a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($videos as $video)
                <div class="bg-white shadow rounded p-4 space-y-2">
                    @php
                        // Extract the video ID from YouTube URL
                        preg_match('/(?:https?:\/\/)?(?:www\.)?(?:youtube\.com\/(?:[^\/\n\s]+\/\S+\/|(?:v|e(?:mbed)?)\/|\S*?[?&]v=)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $video->youtube_link, $matches);
                        $videoId = $matches[1] ?? null;
                    @endphp

                    @if($videoId)
                        <iframe width="100%" height="200"
                                src="https://www.youtube.com/embed/{{ $videoId }}"
                                frameborder="0" allowfullscreen></iframe>
                                <p>{{ $video->title }}</p>
                    @else
                        <p class="text-red-500">Video ID topilmadi. Iltimos, to'g'ri URL kiriting.</p>
                    @endif

                    <p class="text-sm text-gray-500">Yuklangan: {{ $video->created_at->diffForHumans() }}

                    <!-- Delete Button -->
                    <form action="{{ route('videos.destroy', $video->id) }}" method="POST" onsubmit="return confirm('Siz ushbu videoni o‘chirmoqchimisiz?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md mt-4 w-full">O‘chirish</button>
                    </form>
                    </p>
                </div>
            @endforeach
        </div>
        <div class="mt-6">
            {{ $videos->links() }}
        </div>

    </div>
@endsection
