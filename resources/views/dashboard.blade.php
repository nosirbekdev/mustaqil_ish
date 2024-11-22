@extends('layouts.app')

@section('content')
<a href="/" class="items-center text-gray-600"><i class="fas fa-arrow-left"></i> Ortga</a>

<div class="max-w-2xl mx-auto p-6">
    <h1 class="text-3xl font-semibold text-center mb-6">Maqolalar</h1>

    <!-- Qidiruv formasi -->
    <form action="{{ route('dashboard') }}" method="GET" class="mb-6">
        <div class="flex items-center space-x-4">
            <input type="text" name="search" placeholder="Maqolalar orasida qidirish..."
                   class="w-full p-3 border border-gray-300 rounded-md"
                   value="{{ request()->get('search') }}">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md">Qidirish</button>
        </div>
    </form>

    @if(auth()->user()->hasRole('admin'))
        <h2 class="text-xl mb-4">Barcha maqolalar</h2>

        <!-- Maqolalar ro'yxati admin uchun -->
        @if($articles->count() > 0)
            @foreach ($articles as $article)
                <div class="bg-white shadow-lg p-4 mb-4 rounded-lg">
                    <h3 class="text-2xl font-semibold">{{ $article->title }}</h3>
                    <!-- Matnni kesish -->
                    <p class="text-gray-700 text-sm mt-2 overflow-hidden max-h-20 truncate">
                        {{ $article->content }}
                    </p>
                    <!-- Batafsil ko'rish tugmasi -->
                    <a href="{{ route('articles.show', $article->id) }}" class="text-blue-600 hover:underline mt-2 inline-block">
                        Batafsil o'qish
                    </a>

                    @if (!$article->is_approved)
                        <form action="{{ route('articles.approve', $article->id) }}" method="POST" class="inline-block mt-2">
                            @csrf
                            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md">Tasdiqlash</button>
                        </form>
                    @else
                        <p class="text-green-600 mt-2">Maqola tasdiqlangan!</p>
                    @endif
                </div>
            @endforeach
        @else
            <p class="text-center text-gray-500">Hozircha maqolalar yo'q.</p>
        @endif
    @else
        <h2 class="text-xl mb-4">Sizning maqolalaringiz</h2>

        <!-- Maqolalar ro'yxati foydalanuvchi uchun -->
        @if($articles->count() > 0)
            @foreach ($articles as $article)
                <div class="bg-white shadow-lg p-4 mb-4 rounded-lg">
                    <h3 class="text-2xl font-semibold">{{ $article->title }}</h3>
                    <!-- Matnni kesish -->
                    <p class="text-gray-700 text-sm mt-2 overflow-hidden max-h-20 truncate">
                        {{ $article->content }}
                    </p>
                    <!-- Batafsil ko'rish tugmasi -->
                    <a href="{{ route('articles.show', $article->id) }}" class="text-blue-600 hover:underline mt-2 inline-block">
                        Batafsil o'qish
                    </a>

                    @if (!$article->is_approved)
                        <p class="text-yellow-600 mt-2">Maqola ko'rib chiqilmoqda...</p>
                    @else
                        <p class="text-green-600 mt-2">Maqola tasdiqlangan!</p>
                    @endif

                    <!-- Oddiy foydalanuvchi uchun yangilash va o'chirish -->
                    @if(auth()->user()->id === $article->author_id)
                        <a href="{{ route('articles.edit', $article->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded-md mt-2 inline-block">
                            Yangilash
                        </a>

                        <form action="{{ route('articles.destroy', $article->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md mt-2">
                                O'chirish
                            </button>
                        </form>
                    @endif
                </div>
            @endforeach
        @else
            <p class="text-center text-gray-500">Sizda hech qanday maqola mavjud emas.</p>
        @endif
    @endif

    <!-- Pagination -->
    <div class="mt-6">
        {{ $articles->links('vendor.pagination.tailwind') }}
    </div>
</div>
@endsection
