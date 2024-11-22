<div class="container mx-auto w-[100%] text-center p-4 pt-6 md:p-6 lg:p-8">
    <!-- Sarlavha -->
    <h1 class="text-4xl font-serif text-gray-800 mb-4">{{ $title }}</h1>

    <!-- Breadcrumb Yo'li -->
    <span class="text-blue-600 mt-6 mb-4">
        @foreach ($breadcrumbs as $breadcrumb)
            <!-- Breadcrumb elementi -->
            @if (!empty($breadcrumb['url']))
                <a href="{{ $breadcrumb['url'] }}" class="text-blue-600">{{ $breadcrumb['label'] }}</a>
            @else
                <span class="text-black">{{ $breadcrumb['label'] }}</span>
            @endif

            @if (!$loop->last)
                <span class="text-gray-500"> / </span>
            @endif
        @endforeach
    </span>
</div>
