@extends('layouts.app')

@section('content')
<a href="/" class="items-center text-gray-600 mb-4 inline-block"><i class="fas fa-arrow-left"></i> Ortga</a>

<div class="max-w-6xl mx-auto p-6">
    <h1 class="text-3xl font-semibold text-center mb-6">Dashboard</h1>

    <!-- Qidiruv formasi -->
    <form action="{{ route('dashboard') }}" method="GET" class="mb-6">
        <div class="flex items-center space-x-4">
            <input type="text" name="search" placeholder="qidirish..."
                   class="w-full p-3 border border-gray-300 rounded-md"
                   value="{{ request()->get('search') }}">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md">Qidirish</button>
        </div>
    </form>

    <!-- Maqolalar bo'limi -->
    @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('author'))
        <h2 class="text-xl mb-4">Maqolalar</h2>

        <!-- Maqolalar ro'yxati -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach ($articles as $article)
                <div class="bg-white shadow-lg rounded-lg overflow-hidden hover:shadow-xl transition-all duration-300">
                    <div class="p-6">
                        <h3 class="text-2xl font-semibold text-gray-800">{{ $article->title }}</h3>
                        <!-- Matnni kesish -->
                        <p class="text-gray-600 text-sm mt-2 overflow-hidden max-h-20 truncate">
                            {{ $article->content }}
                        </p>
                        <p class="text-gray-600 text-sm mt-2 overflow-hidden max-h-20 truncate">
                            {{ $article->author->name }}
                        </p>
                        <!-- Batafsil ko'rish tugmasi -->
                        <a href="{{ route('articles.show', $article->id) }}" class="text-blue-600 hover:underline mt-4 inline-block">
                            Batafsil o'qish
                        </a>

                        <!-- Admin uchun tasdiqlash -->
                        @if(auth()->user()->hasRole('admin') && !$article->is_approved)
                            <form action="{{ route('articles.approve', $article->id) }}" method="POST" class="inline-block mt-4">
                                @csrf
                                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md w-full">Tasdiqlash</button>
                            </form>
                        @elseif($article->is_approved)
                            <p class="text-green-600 mt-2">Maqola tasdiqlangan!</p>
                            <form action="{{ route('articles.destroy', $article->id) }}" method="POST" class="inline-block w-full mt-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md w-full">
                                    O'chirish
                                </button>
                            </form>
                        @endif

                        <!-- O'z maqolasini o'zgartirish yoki o'chirish -->
                        @if(auth()->user()->id === $article->author_id)
                            <a href="{{ route('articles.edit', $article->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded-md mt-4 inline-block w-auto text-center">
                                Yangilash
                            </a>

                            <form action="{{ route('articles.destroy', $article->id) }}" method="POST" class="inline-block w-full mt-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md w-full">
                                    O'chirish
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        <!-- Pagination -->
        <div class="mt-6">
            {{ $articles->links('vendor.pagination.tailwind') }}
        </div>
    @else
        <h2 class="text-xl mb-4">Sizning maqolalaringiz</h2>

        <!-- Maqolalar ro'yxati foydalanuvchi uchun -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach ($articles as $article)
                <div class="bg-white shadow-lg rounded-lg overflow-hidden hover:shadow-xl transition-all duration-300">
                    <div class="p-6">
                        <h3 class="text-2xl font-semibold text-gray-800">{{ $article->title }}</h3>
                        <!-- Matnni kesish -->
                        <p class="text-gray-600 text-sm mt-2 overflow-hidden max-h-20 truncate">
                            {{ $article->content }}
                        </p>
                        <!-- Batafsil ko'rish tugmasi -->
                        <a href="{{ route('articles.show', $article->id) }}" class="text-blue-600 hover:underline mt-4 inline-block">
                            Batafsil o'qish
                        </a>

                        @if (!$article->is_approved)
                            <p class="text-yellow-600 mt-2">Maqola ko'rib chiqilmoqda...</p>
                        @else
                            <p class="text-green-600 mt-2">Maqola tasdiqlangan!</p>
                        @endif

                        <!-- Oddiy foydalanuvchi uchun yangilash va o'chirish -->
                        @if(auth()->user()->id === $article->author_id)
                            <a href="{{ route('articles.edit', $article->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded-md mt-4 inline-block w-full text-center">
                                Yangilash
                            </a>

                            <form action="{{ route('articles.destroy', $article->id) }}" method="POST" class="inline-block w-full mt-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md w-full">
                                    O'chirish
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        <!-- Pagination -->
        <div class="mt-6">
            {{ $articles->links('vendor.pagination.tailwind') }}
        </div>
    @endif

    <!-- Dissertatsiyalar bo'limi -->
    @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('author'))
        <h2 class="text-xl mb-4">Dissertatsiyalar</h2>

        <!-- Dissertatsiyalar ro'yxati -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach ($dissertations as $article)
                <div class="bg-white shadow-lg rounded-lg overflow-hidden hover:shadow-xl transition-all duration-300">
                    <div class="p-6">
                        <h3 class="text-2xl font-semibold text-gray-800">{{ $article->title }}</h3>
                        <!-- Matnni kesish -->
                        <p class="text-gray-600 text-sm mt-2 overflow-hidden max-h-20 truncate">
                            {{ $article->content }}
                        </p>
                        <p class="text-gray-600 text-sm mt-2 overflow-hidden max-h-20 truncate">
                            {{ $article->author->name }}
                        </p>
                        <!-- Batafsil ko'rish tugmasi -->
                        <a href="{{ route('dissertations.show', $article->id) }}" class="text-blue-600 hover:underline mt-4 inline-block">
                            Batafsil o'qish
                        </a>

                        <!-- Admin uchun tasdiqlash -->
                        @if(auth()->user()->hasRole('admin') && !$article->is_approved)
                            <form action="{{ route('dissertations.approve', $article->id) }}" method="POST" class="inline-block mt-4">
                                @csrf
                                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md w-full">Tasdiqlash</button>
                            </form>
                        @elseif($article->is_approved)
                            <p class="text-green-600 mt-2">Dissertatsiya tasdiqlangan!</p>
                            <form action="{{ route('abstracts.destroy', $article->id) }}" method="POST" class="inline-block w-full mt-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md w-full">
                                    O'chirish
                                </button>
                            </form>
                        @endif

                        <!-- O'z maqolasini o'zgartirish yoki o'chirish -->
                        @if(auth()->user()->id === $article->author_id)
                        <a href="{{ route('dissertations.edit', $article->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded-md mt-4 inline-block w-full text-center">
                            Yangilash
                        </a>


                            <form action="{{ route('dissertations.destroy', $article->id) }}" method="POST" class="inline-block w-full mt-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md w-full">
                                    O'chirish
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        <!-- Pagination -->
        <div class="mt-6">
            {{ $dissertations->links('vendor.pagination.tailwind') }}
        </div>
    @else
        <h2 class="text-xl mb-4">Sizning dissertatsiyalaringiz</h2>

        <!-- Maqolalar ro'yxati foydalanuvchi uchun -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach ($dissertations as $article)
                <div class="bg-white shadow-lg rounded-lg overflow-hidden hover:shadow-xl transition-all duration-300">
                    <div class="p-6">
                        <h3 class="text-2xl font-semibold text-gray-800">{{ $article->title }}</h3>
                        <!-- Matnni kesish -->
                        <p class="text-gray-600 text-sm mt-2 overflow-hidden max-h-20 truncate">
                            {{ $article->content }}
                        </p>
                        <!-- Batafsil ko'rish tugmasi -->
                        <a href="{{ route('dissertations.show', $article->id) }}" class="text-blue-600 hover:underline mt-4 inline-block">
                            Batafsil o'qish
                        </a>

                        @if (!$article->is_approved)
                            <p class="text-yellow-600 mt-2">Maqola ko'rib chiqilmoqda...</p>
                        @else
                            <p class="text-green-600 mt-2">Maqola tasdiqlangan!</p>
                        @endif

                        <!-- Oddiy foydalanuvchi uchun yangilash va o'chirish -->
                        @if(auth()->user()->id === $article->author_id)
                            <a href="{{ route('dissertations.edit', $article->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded-md mt-4 inline-block w-full text-center">
                                Yangilash
                            </a>

                            <form action="{{ route('dissertations.destroy', $article->id) }}" method="POST" class="inline-block w-full mt-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md w-full">
                                    O'chirish
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        <!-- Pagination -->
        <div class="mt-6">
            {{ $dissertations->links('vendor.pagination.tailwind') }}
        </div>
    @endif

    <!-- Avtoreferatlar bo'limi -->
    @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('author'))
        <h2 class="text-xl mb-4">Avtoreferatlar</h2>

        <!-- Avtoreferatlar ro'yxati -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach ($abstracts as $article)
                <div class="bg-white shadow-lg rounded-lg overflow-hidden hover:shadow-xl transition-all duration-300">
                    <div class="p-6">
                        <h3 class="text-2xl font-semibold text-gray-800">{{ $article->title }}</h3>
                        <!-- Matnni kesish -->
                        <p class="text-gray-600 text-sm mt-2 overflow-hidden max-h-20 truncate">
                            {{ $article->content }}
                        </p>
                        <p class="text-gray-600 text-sm mt-2 overflow-hidden max-h-20 truncate">
                            {{ $article->author->name }}
                        </p>

                        <!-- Batafsil ko'rish tugmasi -->

                        <a href="{{ route('abstracts.show', $article->id) }}" class="text-blue-600 hover:underline mt-4 inline-block">
                            Batafsil o'qish
                        </a>

                        <!-- Admin uchun tasdiqlash -->
                        @if(auth()->user()->hasRole('admin') && !$article->is_approved)
                            <form action="{{ route('abstracts.approve', $article->id) }}" method="POST" class="inline-block mt-4">
                                @csrf
                                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md w-full">Tasdiqlash</button>
                            </form>
                        @elseif($article->is_approved)
                            <p class="text-green-600 mt-2">Avtoreferat tasdiqlangan!</p>
                            <form action="{{ route('abstracts.destroy', $article->id) }}" method="POST" class="inline-block w-full mt-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md w-full">
                                    O'chirish
                                </button>
                            </form>
                        @endif

                        <!-- O'z maqolasini o'zgartirish yoki o'chirish -->
                        @if(auth()->user()->id === $article->author_id)
                        <a href="{{ route('abstracts.edit', $article->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded-md mt-4 inline-block w-full text-center">
                            Yangilash
                        </a>


                            <form action="{{ route('abstracts.destroy', $article->id) }}" method="POST" class="inline-block w-full mt-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md w-full">
                                    O'chirish
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        <!-- Pagination -->
        <div class="mt-6">
            {{ $abstracts->links('vendor.pagination.tailwind') }}
        </div>
    @else
        <h2 class="text-xl mb-4">Sizning avtoreferatingiz</h2>

        <!-- Avtoreferatlar ro'yxati foydalanuvchi uchun -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach ($abstracts as $article)
                <div class="bg-white shadow-lg rounded-lg overflow-hidden hover:shadow-xl transition-all duration-300">
                    <div class="p-6">
                        <h3 class="text-2xl font-semibold text-gray-800">{{ $article->title }}</h3>
                        <!-- Matnni kesish -->
                        <p class="text-gray-600 text-sm mt-2 overflow-hidden max-h-20 truncate">
                            {{ $article->content }}
                        </p>
                        <!-- Batafsil ko'rish tugmasi -->
                        <a href="{{ route('abstracts.show', $article->id) }}" class="text-blue-600 hover:underline mt-4 inline-block">
                            Batafsil o'qish
                        </a>

                        @if (!$article->is_approved)
                            <p class="text-yellow-600 mt-2">Maqola ko'rib chiqilmoqda...</p>
                        @else
                            <p class="text-green-600 mt-2">Maqola tasdiqlangan!</p>
                        @endif

                        <!-- Oddiy foydalanuvchi uchun yangilash va o'chirish -->
                        @if(auth()->user()->id === $article->author_id)
                            <a href="{{ route('abstracts.edit', $article->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded-md mt-4 inline-block w-full text-center">
                                Yangilash
                            </a>

                            <form action="{{ route('abstracts.destroy', $article->id) }}" method="POST" class="inline-block w-full mt-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md w-full">
                                    O'chirish
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        <!-- Pagination -->
        <div class="mt-6">
            {{ $abstracts->links('vendor.pagination.tailwind') }}
        </div>
    @endif

    <!-- Monographlar bo'limi -->
    @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('author'))
        <h2 class="text-xl mb-4">Monografiyalar</h2>

        <!-- Monographlar ro'yxati -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach ($monographs as $article)
                <div class="bg-white shadow-lg rounded-lg overflow-hidden hover:shadow-xl transition-all duration-300">
                    <div class="p-6">
                        <h3 class="text-2xl font-semibold text-gray-800">{{ $article->title }}</h3>
                        <!-- Matnni kesish -->
                        <p class="text-gray-600 text-sm mt-2 overflow-hidden max-h-20 truncate">
                            {{ $article->content }}
                        </p>
                        <p class="text-gray-600 text-sm mt-2 overflow-hidden max-h-20 truncate">
                            {{ $article->author->name }}
                        </p>

                        <!-- Batafsil ko'rish tugmasi -->

                        <a href="{{ route('monographs.show', $article->id) }}" class="text-blue-600 hover:underline mt-4 inline-block">
                            Batafsil o'qish
                        </a>

                        <!-- Admin uchun tasdiqlash -->
                        @if(auth()->user()->hasRole('admin') && !$article->is_approved)
                            <form action="{{ route('monographs.approve', $article->id) }}" method="POST" class="inline-block mt-4">
                                @csrf
                                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md w-full">Tasdiqlash</button>
                            </form>
                        @elseif($article->is_approved)
                            <p class="text-green-600 mt-2">Monografiya tasdiqlangan!</p>
                            <form action="{{ route('monographs.destroy', $article->id) }}" method="POST" class="inline-block w-full mt-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md w-full">
                                    O'chirish
                                </button>
                            </form>
                        @endif

                        <!-- O'z maqolasini o'zgartirish yoki o'chirish -->
                        @if(auth()->user()->id === $article->author_id)
                        <a href="{{ route('monographs.edit', $article->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded-md mt-4 inline-block w-full text-center">
                            Yangilash
                        </a>


                            <form action="{{ route('monographs.destroy', $article->id) }}" method="POST" class="inline-block w-full mt-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md w-full">
                                    O'chirish
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        <!-- Pagination -->
        <div class="mt-6">
            {{ $monographs->links('vendor.pagination.tailwind') }}
        </div>
    @else
        <h2 class="text-xl mb-4">Sizning monografiyalaringiz</h2>

        <!-- Monographlar ro'yxati foydalanuvchi uchun -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach ($monographs as $article)
                <div class="bg-white shadow-lg rounded-lg overflow-hidden hover:shadow-xl transition-all duration-300">
                    <div class="p-6">
                        <h3 class="text-2xl font-semibold text-gray-800">{{ $article->title }}</h3>
                        <!-- Matnni kesish -->
                        <p class="text-gray-600 text-sm mt-2 overflow-hidden max-h-20 truncate">
                            {{ $article->content }}
                        </p>
                        <!-- Batafsil ko'rish tugmasi -->
                        <a href="{{ route('monographs.show', $article->id) }}" class="text-blue-600 hover:underline mt-4 inline-block">
                            Batafsil o'qish
                        </a>

                        @if (!$article->is_approved)
                            <p class="text-yellow-600 mt-2">Maqola ko'rib chiqilmoqda...</p>
                        @else
                            <p class="text-green-600 mt-2">Maqola tasdiqlangan!</p>
                        @endif

                        <!-- Oddiy foydalanuvchi uchun yangilash va o'chirish -->
                        @if(auth()->user()->id === $article->author_id)
                            <a href="{{ route('monographs.edit', $article->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded-md mt-4 inline-block w-full text-center">
                                Yangilash
                            </a>

                            <form action="{{ route('monographs.destroy', $article->id) }}" method="POST" class="inline-block w-full mt-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md w-full">
                                    O'chirish
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        <!-- Pagination -->
        <div class="mt-6">
            {{ $monographs->links('vendor.pagination.tailwind') }}
        </div>
    @endif

    <!-- Europes bo'limi -->
    @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('author'))
        <h2 class="text-xl mb-4">Yevropa maqolari</h2>

        <!-- Europes ro'yxati -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach ($europes as $article)
                <div class="bg-white shadow-lg rounded-lg overflow-hidden hover:shadow-xl transition-all duration-300">
                    <div class="p-6">
                        <h3 class="text-2xl font-semibold text-gray-800">{{ $article->title }}</h3>
                        <!-- Matnni kesish -->
                        <p class="text-gray-600 text-sm mt-2 overflow-hidden max-h-20 truncate">
                            {{ $article->content }}
                        </p>
                        <p class="text-gray-600 text-sm mt-2 overflow-hidden max-h-20 truncate">
                            {{ $article->author->name }}
                        </p>

                        <!-- Batafsil ko'rish tugmasi -->

                        <a href="{{ route('europes.show', $article->id) }}" class="text-blue-600 hover:underline mt-4 inline-block">
                            Batafsil o'qish
                        </a>

                        <!-- Admin uchun tasdiqlash -->
                        @if(auth()->user()->hasRole('admin') && !$article->is_approved)
                            <form action="{{ route('europes.approve', $article->id) }}" method="POST" class="inline-block mt-4">
                                @csrf
                                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md w-full">Tasdiqlash</button>
                            </form>
                        @elseif($article->is_approved)
                            <p class="text-green-600 mt-2">Monografiya tasdiqlangan!</p>
                            <form action="{{ route('europes.destroy', $article->id) }}" method="POST" class="inline-block w-full mt-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md w-full">
                                    O'chirish
                                </button>
                            </form>
                        @endif

                        <!-- O'z maqolasini o'zgartirish yoki o'chirish -->
                        @if(auth()->user()->id === $article->author_id)
                        <a href="{{ route('europes.edit', $article->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded-md mt-4 inline-block w-full text-center">
                            Yangilash
                        </a>


                            <form action="{{ route('europes.destroy', $article->id) }}" method="POST" class="inline-block w-full mt-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md w-full">
                                    O'chirish
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        <!-- Pagination -->
        <div class="mt-6">
            {{ $europes->links('vendor.pagination.tailwind') }}
        </div>
    @else
        <h2 class="text-xl mb-4">Yevropa maqolalaringiz</h2>

        <!-- Europes ro'yxati foydalanuvchi uchun -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach ($europes as $article)
                <div class="bg-white shadow-lg rounded-lg overflow-hidden hover:shadow-xl transition-all duration-300">
                    <div class="p-6">
                        <h3 class="text-2xl font-semibold text-gray-800">{{ $article->title }}</h3>
                        <!-- Matnni kesish -->
                        <p class="text-gray-600 text-sm mt-2 overflow-hidden max-h-20 truncate">
                            {{ $article->content }}
                        </p>
                        <!-- Batafsil ko'rish tugmasi -->
                        <a href="{{ route('europes.show', $article->id) }}" class="text-blue-600 hover:underline mt-4 inline-block">
                            Batafsil o'qish
                        </a>

                        @if (!$article->is_approved)
                            <p class="text-yellow-600 mt-2">Maqola ko'rib chiqilmoqda...</p>
                        @else
                            <p class="text-green-600 mt-2">Maqola tasdiqlangan!</p>
                        @endif

                        <!-- Oddiy foydalanuvchi uchun yangilash va o'chirish -->
                        @if(auth()->user()->id === $article->author_id)
                            <a href="{{ route('europes.edit', $article->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded-md mt-4 inline-block w-full text-center">
                                Yangilash
                            </a>

                            <form action="{{ route('europes.destroy', $article->id) }}" method="POST" class="inline-block w-full mt-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md w-full">
                                    O'chirish
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        <!-- Pagination -->
        <div class="mt-6">
            {{ $europes->links('vendor.pagination.tailwind') }}
        </div>
    @endif

    <!-- Americans bo'limi -->
    @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('author'))
        <h2 class="text-xl mb-4">Amerika maqolari</h2>

        <!-- Americans ro'yxati -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach ($americans as $article)
                <div class="bg-white shadow-lg rounded-lg overflow-hidden hover:shadow-xl transition-all duration-300">
                    <div class="p-6">
                        <h3 class="text-2xl font-semibold text-gray-800">{{ $article->title }}</h3>
                        <!-- Matnni kesish -->
                        <p class="text-gray-600 text-sm mt-2 overflow-hidden max-h-20 truncate">
                            {{ $article->content }}
                        </p>
                        <p class="text-gray-600 text-sm mt-2 overflow-hidden max-h-20 truncate">
                            {{ $article->author->name }}
                        </p>

                        <!-- Batafsil ko'rish tugmasi -->

                        <a href="{{ route('americans.show', $article->id) }}" class="text-blue-600 hover:underline mt-4 inline-block">
                            Batafsil o'qish
                        </a>

                        <!-- Admin uchun tasdiqlash -->
                        @if(auth()->user()->hasRole('admin') && !$article->is_approved)
                            <form action="{{ route('americans.approve', $article->id) }}" method="POST" class="inline-block mt-4">
                                @csrf
                                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md w-full">Tasdiqlash</button>
                            </form>
                        @elseif($article->is_approved)
                            <p class="text-green-600 mt-2">Monografiya tasdiqlangan!</p>
                            <form action="{{ route('americans.destroy', $article->id) }}" method="POST" class="inline-block w-full mt-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md w-full">
                                    O'chirish
                                </button>
                            </form>
                        @endif

                        <!-- O'z maqolasini o'zgartirish yoki o'chirish -->
                        @if(auth()->user()->id === $article->author_id)
                        <a href="{{ route('americans.edit', $article->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded-md mt-4 inline-block w-full text-center">
                            Yangilash
                        </a>


                            <form action="{{ route('americans.destroy', $article->id) }}" method="POST" class="inline-block w-full mt-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md w-full">
                                    O'chirish
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        <!-- Pagination -->
        <div class="mt-6">
            {{ $americans->links('vendor.pagination.tailwind') }}
        </div>
    @else
        <h2 class="text-xl mb-4">Amerika maqolalaringiz</h2>

        <!-- americans ro'yxati foydalanuvchi uchun -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach ($americans as $article)
                <div class="bg-white shadow-lg rounded-lg overflow-hidden hover:shadow-xl transition-all duration-300">
                    <div class="p-6">
                        <h3 class="text-2xl font-semibold text-gray-800">{{ $article->title }}</h3>
                        <!-- Matnni kesish -->
                        <p class="text-gray-600 text-sm mt-2 overflow-hidden max-h-20 truncate">
                            {{ $article->content }}
                        </p>
                        <!-- Batafsil ko'rish tugmasi -->
                        <a href="{{ route('americans.show', $article->id) }}" class="text-blue-600 hover:underline mt-4 inline-block">
                            Batafsil o'qish
                        </a>

                        @if (!$article->is_approved)
                            <p class="text-yellow-600 mt-2">Maqola ko'rib chiqilmoqda...</p>
                        @else
                            <p class="text-green-600 mt-2">Maqola tasdiqlangan!</p>
                        @endif

                        <!-- Oddiy foydalanuvchi uchun yangilash va o'chirish -->
                        @if(auth()->user()->id === $article->author_id)
                            <a href="{{ route('americans.edit', $article->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded-md mt-4 inline-block w-full text-center">
                                Yangilash
                            </a>

                            <form action="{{ route('americans.destroy', $article->id) }}" method="POST" class="inline-block w-full mt-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md w-full">
                                    O'chirish
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        <!-- Pagination -->
        <div class="mt-6">
            {{ $americans->links('vendor.pagination.tailwind') }}
        </div>
    @endif

    <!-- Turkish bo'limi -->
    @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('author'))
        <h2 class="text-xl mb-4">Turkiya maqolari</h2>

        <!-- Turkish ro'yxati -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach ($turkishes as $article)
                <div class="bg-white shadow-lg rounded-lg overflow-hidden hover:shadow-xl transition-all duration-300">
                    <div class="p-6">
                        <h3 class="text-2xl font-semibold text-gray-800">{{ $article->title }}</h3>
                        <!-- Matnni kesish -->
                        <p class="text-gray-600 text-sm mt-2 overflow-hidden max-h-20 truncate">
                            {{ $article->content }}
                        </p>
                        <p class="text-gray-600 text-sm mt-2 overflow-hidden max-h-20 truncate">
                            {{ $article->author->name }}
                        </p>

                        <!-- Batafsil ko'rish tugmasi -->

                        <a href="{{ route('turkishes.show', $article->id) }}" class="text-blue-600 hover:underline mt-4 inline-block">
                            Batafsil o'qish
                        </a>

                        <!-- Admin uchun tasdiqlash -->
                        @if(auth()->user()->hasRole('admin') && !$article->is_approved)
                            <form action="{{ route('turkishes.approve', $article->id) }}" method="POST" class="inline-block mt-4">
                                @csrf
                                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md w-full">Tasdiqlash</button>
                            </form>
                        @elseif($article->is_approved)
                            <p class="text-green-600 mt-2">Monografiya tasdiqlangan!</p>
                            <form action="{{ route('turkishes.destroy', $article->id) }}" method="POST" class="inline-block w-full mt-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md w-full">
                                    O'chirish
                                </button>
                            </form>
                        @endif

                        <!-- O'z maqolasini o'zgartirish yoki o'chirish -->
                        @if(auth()->user()->id === $article->author_id)
                        <a href="{{ route('turkishes.edit', $article->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded-md mt-4 inline-block w-full text-center">
                            Yangilash
                        </a>


                            <form action="{{ route('turkishes.destroy', $article->id) }}" method="POST" class="inline-block w-full mt-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md w-full">
                                    O'chirish
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        <!-- Pagination -->
        <div class="mt-6">
            {{ $turkishes->links('vendor.pagination.tailwind') }}
        </div>
    @else
        <h2 class="text-xl mb-4">Turkiya maqolalaringiz</h2>

        <!-- Turkish ro'yxati foydalanuvchi uchun -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach ($turkishes as $article)
                <div class="bg-white shadow-lg rounded-lg overflow-hidden hover:shadow-xl transition-all duration-300">
                    <div class="p-6">
                        <h3 class="text-2xl font-semibold text-gray-800">{{ $article->title }}</h3>
                        <!-- Matnni kesish -->
                        <p class="text-gray-600 text-sm mt-2 overflow-hidden max-h-20 truncate">
                            {{ $article->content }}
                        </p>
                        <!-- Batafsil ko'rish tugmasi -->
                        <a href="{{ route('turkishes.show', $article->id) }}" class="text-blue-600 hover:underline mt-4 inline-block">
                            Batafsil o'qish
                        </a>

                        @if (!$article->is_approved)
                            <p class="text-yellow-600 mt-2">Maqola ko'rib chiqilmoqda...</p>
                        @else
                            <p class="text-green-600 mt-2">Maqola tasdiqlangan!</p>
                        @endif

                        <!-- Oddiy foydalanuvchi uchun yangilash va o'chirish -->
                        @if(auth()->user()->id === $article->author_id)
                            <a href="{{ route('turkishes.edit', $article->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded-md mt-4 inline-block w-full text-center">
                                Yangilash
                            </a>

                            <form action="{{ route('turkishes.destroy', $article->id) }}" method="POST" class="inline-block w-full mt-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md w-full">
                                    O'chirish
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        <!-- Pagination -->
        <div class="mt-6">
            {{ $turkishes->links('vendor.pagination.tailwind') }}
        </div>
    @endif

    <!-- Russian bo'limi -->
    @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('author'))
        <h2 class="text-xl mb-4">Rossiya maqolari</h2>

        <!-- Russian ro'yxati -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach ($russias as $article)
                <div class="bg-white shadow-lg rounded-lg overflow-hidden hover:shadow-xl transition-all duration-300">
                    <div class="p-6">
                        <h3 class="text-2xl font-semibold text-gray-800">{{ $article->title }}</h3>
                        <!-- Matnni kesish -->
                        <p class="text-gray-600 text-sm mt-2 overflow-hidden max-h-20 truncate">
                            {{ $article->content }}
                        </p>
                        <p class="text-gray-600 text-sm mt-2 overflow-hidden max-h-20 truncate">
                            {{ $article->author->name }}
                        </p>

                        <!-- Batafsil ko'rish tugmasi -->

                        <a href="{{ route('russia.show', $article->id) }}" class="text-blue-600 hover:underline mt-4 inline-block">
                            Batafsil o'qish
                        </a>

                        <!-- Admin uchun tasdiqlash -->
                        @if(auth()->user()->hasRole('admin') && !$article->is_approved)
                            <form action="{{ route('russia.approve', $article->id) }}" method="POST" class="inline-block mt-4">
                                @csrf
                                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md w-full">Tasdiqlash</button>
                            </form>
                        @elseif($article->is_approved)
                            <p class="text-green-600 mt-2">Monografiya tasdiqlangan!</p>
                            <form action="{{ route('russia.destroy', $article->id) }}" method="POST" class="inline-block w-full mt-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md w-full">
                                    O'chirish
                                </button>
                            </form>
                        @endif

                        <!-- O'z maqolasini o'zgartirish yoki o'chirish -->
                        @if(auth()->user()->id === $article->author_id)
                        <a href="{{ route('russia.edit', $article->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded-md mt-4 inline-block w-full text-center">
                            Yangilash
                        </a>


                            <form action="{{ route('russia.destroy', $article->id) }}" method="POST" class="inline-block w-full mt-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md w-full">
                                    O'chirish
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        <!-- Pagination -->
        <div class="mt-6">
            {{ $russias->links('vendor.pagination.tailwind') }}
        </div>
    @else
        <h2 class="text-xl mb-4">Rossiya maqolalaringiz</h2>

        <!-- Turkish ro'yxati foydalanuvchi uchun -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach ($russias as $article)
                <div class="bg-white shadow-lg rounded-lg overflow-hidden hover:shadow-xl transition-all duration-300">
                    <div class="p-6">
                        <h3 class="text-2xl font-semibold text-gray-800">{{ $article->title }}</h3>
                        <!-- Matnni kesish -->
                        <p class="text-gray-600 text-sm mt-2 overflow-hidden max-h-20 truncate">
                            {{ $article->content }}
                        </p>
                        <!-- Batafsil ko'rish tugmasi -->
                        <a href="{{ route('russia.show', $article->id) }}" class="text-blue-600 hover:underline mt-4 inline-block">
                            Batafsil o'qish
                        </a>

                        @if (!$article->is_approved)
                            <p class="text-yellow-600 mt-2">Maqola ko'rib chiqilmoqda...</p>
                        @else
                            <p class="text-green-600 mt-2">Maqola tasdiqlangan!</p>
                        @endif

                        <!-- Oddiy foydalanuvchi uchun yangilash va o'chirish -->
                        @if(auth()->user()->id === $article->author_id)
                            <a href="{{ route('russia.edit', $article->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded-md mt-4 inline-block w-full text-center">
                                Yangilash
                            </a>

                            <form action="{{ route('russia.destroy', $article->id) }}" method="POST" class="inline-block w-full mt-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md w-full">
                                    O'chirish
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        <!-- Pagination -->
        <div class="mt-6">
            {{ $russias->links('vendor.pagination.tailwind') }}
        </div>
    @endif

    <!-- Asia bo'limi -->
    @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('author'))
        <h2 class="text-xl mb-4">Markaziy osiyo maqolari</h2>

        <!-- Asia ro'yxati -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach ($asias as $article)
                <div class="bg-white shadow-lg rounded-lg overflow-hidden hover:shadow-xl transition-all duration-300">
                    <div class="p-6">
                        <h3 class="text-2xl font-semibold text-gray-800">{{ $article->title }}</h3>
                        <!-- Matnni kesish -->
                        <p class="text-gray-600 text-sm mt-2 overflow-hidden max-h-20 truncate">
                            {{ $article->content }}
                        </p>
                        <p class="text-gray-600 text-sm mt-2 overflow-hidden max-h-20 truncate">
                            {{ $article->author->name }}
                        </p>

                        <!-- Batafsil ko'rish tugmasi -->

                        <a href="{{ route('asia.show', $article->id) }}" class="text-blue-600 hover:underline mt-4 inline-block">
                            Batafsil o'qish
                        </a>

                        <!-- Admin uchun tasdiqlash -->
                        @if(auth()->user()->hasRole('admin') && !$article->is_approved)
                            <form action="{{ route('asia.approve', $article->id) }}" method="POST" class="inline-block mt-4">
                                @csrf
                                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md w-full">Tasdiqlash</button>
                            </form>
                        @elseif($article->is_approved)
                            <p class="text-green-600 mt-2">Monografiya tasdiqlangan!</p>
                            <form action="{{ route('asia.destroy', $article->id) }}" method="POST" class="inline-block w-full mt-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md w-full">
                                    O'chirish
                                </button>
                            </form>
                        @endif

                        <!-- O'z maqolasini o'zgartirish yoki o'chirish -->
                        @if(auth()->user()->id === $article->author_id)
                        <a href="{{ route('asia.edit', $article->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded-md mt-4 inline-block w-full text-center">
                            Yangilash
                        </a>


                            <form action="{{ route('asia.destroy', $article->id) }}" method="POST" class="inline-block w-full mt-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md w-full">
                                    O'chirish
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        <!-- Pagination -->
        <div class="mt-6">
            {{ $asias->links('vendor.pagination.tailwind') }}
        </div>
    @else
        <h2 class="text-xl mb-4">Markaziy osiyo maqolalaringiz</h2>

        <!-- Turkish ro'yxati foydalanuvchi uchun -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach ($asias as $article)
                <div class="bg-white shadow-lg rounded-lg overflow-hidden hover:shadow-xl transition-all duration-300">
                    <div class="p-6">
                        <h3 class="text-2xl font-semibold text-gray-800">{{ $article->title }}</h3>
                        <!-- Matnni kesish -->
                        <p class="text-gray-600 text-sm mt-2 overflow-hidden max-h-20 truncate">
                            {{ $article->content }}
                        </p>
                        <!-- Batafsil ko'rish tugmasi -->
                        <a href="{{ route('asia.show', $article->id) }}" class="text-blue-600 hover:underline mt-4 inline-block">
                            Batafsil o'qish
                        </a>

                        @if (!$article->is_approved)
                            <p class="text-yellow-600 mt-2">Maqola ko'rib chiqilmoqda...</p>
                        @else
                            <p class="text-green-600 mt-2">Maqola tasdiqlangan!</p>
                        @endif

                        <!-- Oddiy foydalanuvchi uchun yangilash va o'chirish -->
                        @if(auth()->user()->id === $article->author_id)
                            <a href="{{ route('asia.edit', $article->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded-md mt-4 inline-block w-full text-center">
                                Yangilash
                            </a>

                            <form action="{{ route('asia.destroy', $article->id) }}" method="POST" class="inline-block w-full mt-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md w-full">
                                    O'chirish
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        <!-- Pagination -->
        <div class="mt-6">
            {{ $asias->links('vendor.pagination.tailwind') }}
        </div>
    @endif

    <!-- Journal bo'limi -->
    @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('author'))
        <h2 class="text-xl mb-4">Jurnallar</h2>

        <!-- Journal ro'yxati -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach ($journals as $article)
                <div class="bg-white shadow-lg rounded-lg overflow-hidden hover:shadow-xl transition-all duration-300">
                    <div class="p-6">
                        <h3 class="text-2xl font-semibold text-gray-800">{{ $article->title }}</h3>
                        <!-- Matnni kesish -->
                        <p class="text-gray-600 text-sm mt-2 overflow-hidden max-h-20 truncate">
                            {{ $article->content }}
                        </p>
                        <p class="text-gray-600 text-sm mt-2 overflow-hidden max-h-20 truncate">
                            {{ $article->author->name }}
                        </p>

                        <!-- Batafsil ko'rish tugmasi -->

                        <a href="{{ route('journal.show', $article->id) }}" class="text-blue-600 hover:underline mt-4 inline-block">
                            Batafsil o'qish
                        </a>

                        <!-- Admin uchun tasdiqlash -->
                        @if(auth()->user()->hasRole('admin') && !$article->is_approved)
                            <form action="{{ route('journal.approve', $article->id) }}" method="POST" class="inline-block mt-4">
                                @csrf
                                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md w-full">Tasdiqlash</button>
                            </form>
                        @elseif($article->is_approved)
                            <p class="text-green-600 mt-2">Monografiya tasdiqlangan!</p>
                            <form action="{{ route('journal.destroy', $article->id) }}" method="POST" class="inline-block w-full mt-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md w-full">
                                    O'chirish
                                </button>
                            </form>
                        @endif

                        <!-- O'z maqolasini o'zgartirish yoki o'chirish -->
                        @if(auth()->user()->id === $article->author_id)
                        <a href="{{ route('journals.edit', $article->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded-md mt-4 inline-block w-full text-center">
                            Yangilash
                        </a>


                            <form action="{{ route('journal.destroy', $article->id) }}" method="POST" class="inline-block w-full mt-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md w-full">
                                    O'chirish
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        <!-- Pagination -->
        <div class="mt-6">
            {{ $journals->links('vendor.pagination.tailwind') }}
        </div>
    @else
        <h2 class="text-xl mb-4">Jurnallaringiz</h2>

        <!-- Turkish ro'yxati foydalanuvchi uchun -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
            @foreach ($journals as $article)
                <div class="bg-white shadow-lg rounded-lg overflow-hidden hover:shadow-xl transition-all duration-300">
                    <div class="p-6">
                        <h3 class="text-2xl font-semibold text-gray-800">{{ $article->title }}</h3>
                        <!-- Matnni kesish -->
                        <p class="text-gray-600 text-sm mt-2 overflow-hidden max-h-20 truncate">
                            {{ $article->content }}
                        </p>
                        <!-- Batafsil ko'rish tugmasi -->
                        <a href="{{ route('journal.show', $article->id) }}" class="text-blue-600 hover:underline mt-4 inline-block">
                            Batafsil o'qish
                        </a>

                        @if (!$article->is_approved)
                            <p class="text-yellow-600 mt-2">Maqola ko'rib chiqilmoqda...</p>
                        @else
                            <p class="text-green-600 mt-2">Maqola tasdiqlangan!</p>
                        @endif

                        <!-- Oddiy foydalanuvchi uchun yangilash va o'chirish -->
                        @if(auth()->user()->id === $article->author_id)
                            <a href="{{ route('journals.edit', $article->id) }}" class="bg-yellow-500 text-white px-4 py-2 rounded-md mt-4 inline-block w-full text-center">
                                Yangilash
                            </a>

                            <form action="{{ route('journal.destroy', $article->id) }}" method="POST" class="inline-block w-full mt-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md w-full">
                                    O'chirish
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        <!-- Pagination -->
        <div class="mt-6">
            {{ $journals->links('vendor.pagination.tailwind') }}
        </div>
    @endif

</div>
@endsection
