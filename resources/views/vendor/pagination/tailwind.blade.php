<div class="flex justify-center space-x-2">
    @if (!$paginator->onFirstPage())
        <a href="{{ $paginator->previousPageUrl() }}" class="px-4 py-2 bg-blue-500 text-white rounded-md">Orqaga</a>
    @endif

    @if ($paginator->hasMorePages())
        <a href="{{ $paginator->nextPageUrl() }}" class="px-4 py-2 bg-blue-500 text-white rounded-md">Keyingi</a>
    @endif
</div>
