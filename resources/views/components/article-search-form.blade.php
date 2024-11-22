<div class="bg-white p-6 rounded-lg shadow-lg max-w-6xl container mx-auto">
    <p class="text-center block mb-2 text-base border p-2">{{ $title }}</p>
    <h2 class="text-4xl font-serif text-center mb-4">{{ $subtitle  }}</h2>
    <form action="{{ $action ?? url('user/about/articles') }}" method="GET">
        <div class="flex justify-between w-full gap-4">
            <div class="mb-4 w-1/2">
                <select id="search_publisher" name="search_publisher" class="w-full border-gray-300 rounded-lg">
                    <option value="" disabled selected>{{$option}}</option>
                    @foreach ($publishers as $publisher)
                        <option value="{{ $publisher }}" {{ request('search_publisher') == $publisher ? 'selected' : '' }}>
                            {{ $publisher }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4 w-1/2">
                <select id="search_language" name="search_language" class="w-full border-gray-300 rounded-lg">
                    <option value="" disabled selected>Tilni tanlang</option>
                    @foreach ($languages as $key => $language)
                        <option value="{{ $key }}" {{ request('search_language') == $key ? 'selected' : '' }}>
                            {{ $language }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="mb-4">
            <input type="text" id="q" name="q" class="w-full border-gray-300 rounded-lg mt-4" placeholder="Kalit so'zini kiriting" value="{{ request('q') }}">
        </div>
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Qidirish</button>
    </form>
</div>
