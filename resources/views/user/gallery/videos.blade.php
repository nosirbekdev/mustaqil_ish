<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Videolar</title>
      @vite('resources/css/app.css')
</head>
<body>
@include('components.header')
<main class="bg-white">

<x-breadcrumb
    title="Videolar"
    :breadcrumbs="[
        ['label' => 'Asosiy sahifa', 'url' => '/'],
        ['label' => 'Galeriya', 'url' => '/user/gallery/videos'],
        ['label' => 'Videolar', 'url' => null],
    ]"
/>

<section class="text-gray-600 body-font">
  <div class="container px-5 py-14 max-w-6xl mx-auto">

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
                    @endif


                    </p>
                </div>
            @endforeach
        </div>
    </div>
</section>

</main>
@include('components.footer')
</body>
</html>
