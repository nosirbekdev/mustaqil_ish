<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    @vite('resources/css/app.css')
    <title>O`quv qo`llanmalar</title>
</head>
<body class="bg-gray-100">
@include('components.header')

    <!-- Search Form -->
    <div class="bg-white py-24">
    <x-article-search-form
    title="O`quv qo`llanmalar"
    subtitle="O`quv qo`llanma qidirish uchun ma`lumotlarni to`ldiring"
    action="{{ url('user/about/manuals') }}"
    option="Yilni tanlang"
    :publishers="config('books.years')"
    :languages="config('books.languages')"
/>

        <!-- Display Books Based on Search -->
        <div class="container mx-auto p-4 space-y-4 max-w-6xl mt-10">
    @if (!request()->has('q') && !request()->has('search_publisher') && !request()->has('search_language'))
        <div class="max-h-96 overflow-y-auto scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-gray-200">
            @foreach (config('books.maqola') as $book)
                <div class="flex items-center gap-4 bg-sky-50/50 p-4 rounded-lg hover:bg-sky-50/80 transition-colors">
                    <div class="shrink-0">
                        <img src="{{ $book['image'] }}" alt="{{ $book['title'] }}" class="w-24 h-32 object-cover rounded-md border shadow-sm">
                    </div>
                    <div class="flex-grow">
                        <h2 class="text-xl font-semibold">{{ $book['title'] }}</h2>
                        <p class="text-gray-600 mt-1">{{ $book['subtitle'] ?? '' }}</p>
                    </div>
                    <button class="bg-indigo-900 hover:bg-indigo-800 text-white shrink-0 py-2 px-6 rounded-md"><a href="#">O'quv qo'llanmalar sahifasi</a></button>
                </div>
            @endforeach
        </div>
    @elseif(isset($books) && $books->isNotEmpty())
        <!-- Display filtered books -->
        <div class="max-h-96 overflow-y-auto scrollbar-thin scrollbar-thumb-gray-400 scrollbar-track-gray-200">
            @foreach ($books as $book)
                <div class="flex items-center gap-4 bg-sky-50/50 p-4 rounded-lg hover:bg-sky-50/80 transition-colors">
                    <div class="shrink-0">
                        <img src="{{ $book['image'] }}" alt="{{ $book['title'] }}" class="w-24 h-32 object-cover rounded-md border shadow-sm">
                    </div>
                    <div class="flex-grow">
                        <h2 class="text-xl font-semibold">{{ $book['title'] }}</h2>
                        <p class="text-gray-600 mt-1">{{ $book['subtitle'] ?? '' }}</p>
                        <p class="text-gray-600 mt-1">{{ $book['subtitle'] ?? '' }}</p>
                    </div>
                    <button class="bg-indigo-900 hover:bg-indigo-800 text-white shrink-0 py-2 px-6 rounded-md"><a href="#">O'quv qo'llanmalar sahifasi</a></button>
                </div>
            @endforeach
        </div>
    @else
        <!-- Display message if no search results found -->
        <p class="text-gray-600 text-center">Qidiruv natijalari topilmadi.</p>
    @endif
</div>

    </div>

@include('components.footer')
</body>
</html>
