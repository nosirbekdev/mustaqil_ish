@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto p-6">
    <h1 class="text-3xl font-semibold text-center mb-6">Yaratish</h1>

    <div class="bg-white shadow-lg rounded-lg p-8">
        <form id="dynamic-form" action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Dropdown -->
            <div class="mb-4">
                <label for="type" class="block text-sm font-medium text-gray-700">Yaratish turi:</label>
                <select name="type" id="type" class="w-full p-3 mt-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="" selected disabled>Tanlang</option> <!-- Default empty option -->
                    @foreach (config('article_types.types') as $value => $label)
                        <option value="{{ $value }}" {{ old('type') == $value ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
            </div>


            <!-- Title -->
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700">Sarlavha:</label>
                <input type="text" name="title" id="title" class="w-full p-3 mt-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Sarlavhasini kiriting" required>
            </div>

            <!-- Image -->
            <div class="mb-4">
                <label for="image" class="block text-sm font-medium text-gray-700">Rasm yuklash:</label>
                <input type="file" name="image" id="image" class="w-full p-3 mt-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" accept="image/*">
            </div>

            <!-- PDF -->
             <div class="mb-4">
                <label for="pdf" class="block text-sm font-medium text-gray-700">PDF fayl yuklash:</label>
                <input type="file" name="pdf" id="pdf" class="w-full p-3 mt-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" accept="application/pdf">
            </div>

            <!-- Content -->
            <div class="mb-4">
                <label for="content" class="block text-sm font-medium text-gray-700">Matn:</label>
                <textarea name="content" id="content" class="w-full p-3 mt-1 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" placeholder="Matnini kiriting" required></textarea>
            </div>

            <button type="submit" class="w-full py-3 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition duration-300">Yuborish</button>
        </form>
    </div>
</div>

<script>
    // Dropdown o'zgarganda formani boshqa URL'ga yo'naltirish
    document.getElementById('type').addEventListener('change', function () {
        const form = document.getElementById('dynamic-form');
        const type = this.value;

        // Marshrutlarni belgilash
        let actionUrl = '';
        if (type === 'article') {
            actionUrl = "{{ route('articles.store') }}";
        } else if (type === 'dissertation') {
            actionUrl = "{{ route('dissertations.store') }}";
        } else if (type === 'abstract') {
            actionUrl = "{{ route('abstracts.store') }}";
        } else if (type === 'monograph') {
            actionUrl = "{{ route('monographs.store') }}";
        } else if (type === 'europe') {
            actionUrl = "{{ route('europes.store') }}";
        } else if (type === 'american') {
            actionUrl = "{{ route('americans.store') }}";
        } else if (type === 'turkish') {
            actionUrl = "{{ route('turkishes.store') }}";
        } else if (type === 'russia') {
            actionUrl = "{{ route('russia.store') }}";
        } else if (type === 'asia') {
            actionUrl = "{{ route('asia.store') }}";
        } else if (type === 'journal') {
            actionUrl = "{{ route('journal.store') }}";
        }

        // Form action'ini yangilash
        form.action = actionUrl;
    });
</script>
@endsection
