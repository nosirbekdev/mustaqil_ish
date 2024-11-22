<div class="container mx-auto p-4 space-y-4 max-w-6xl mt-10">
    @foreach ($books as $book)
        <div class="flex items-center gap-4 bg-sky-50/50 p-4 rounded-lg hover:bg-sky-50/80 transition-colors">
            <div class="shrink-0">
                <img src="{{ $book['image'] }}" alt="{{ $book['title'] }}" class="w-24 h-32 object-cover rounded-md border shadow-sm">
            </div>
            <div class="flex-grow">
                <h2 class="text-xl font-semibold">{{ $book['title'] }}</h2>
                <p class="text-gray-600 mt-1">{{ $book['subtitle'] ?? '' }}</p>
            </div>
            <button class="bg-indigo-900 hover:bg-indigo-800 text-white shrink-0 py-2 px-6 rounded-md">
                <a href="{{ $book['url'] ?? '#' }}">Jurnal sahifa</a>
            </button>
        </div>
    @endforeach
</div>
