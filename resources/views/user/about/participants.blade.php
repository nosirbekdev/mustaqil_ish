<!DOCTYPE html>
<html lang="uz">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Participants</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body class="font-sans">

@include('components.header')

<section class="text-gray-600 body-font bg-white">
<x-breadcrumb
    title="Loyiha Ishtirokchilari"
    :breadcrumbs="[
        ['label' => 'Asosiy sahifa', 'url' => '/'],
        ['label' => 'Loyiha haqida', 'url' => '/user/about/participants'],
        ['label' => 'Loyiha Ishtirokchilari', 'url' => null],
    ]"
/>

    <div class="container px-5 py-20 mx-auto max-w-6xl">
        <div class="flex flex-wrap -m-4">
            @foreach (config('cards.participants') as $index => $participant)
                <div class="p-4 lg:w-1/2 card {{ $index % 2 == 0 ? 'left' : 'right' }}">
                    <div class="h-full flex sm:flex-row flex-col items-center sm:justify-start justify-center text-center sm:text-left">
                        <img alt="{{ $participant['name'] }}" class="flex-shrink-0 rounded-lg w-48 h-48 object-cover object-center sm:mb-0 mb-4" src="{{ $participant['image'] }}">
                        <div class="flex-grow sm:pl-8">
                            <h2 class="title-font font-medium text-lg text-gray-900">{{ $participant['name'] }}</h2>
                            <h3 class="text-gray-500 mb-2">{{ $participant['title'] }}</h3>
                            <a href="mailto:{{ $participant['email'] }}" class="text-blue-400">{{ $participant['email'] }}</a>
                            <p class="mb-2 mt-2">{{ $participant['description'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

@include('components.footer')

</body>
</html>
