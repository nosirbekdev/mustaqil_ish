@extends('layouts.app')

@section('title', 'Dissertatsiyani Tahrirlash')

@section('content')
<div class="container mx-auto py-10">
    <div class="flex justify-center">
        <div class="w-full max-w-2xl">
            <div class="bg-white shadow-md rounded-lg">
                <div class="bg-blue-600 text-white p-4 rounded-t-lg">
                    <h4 class="text-lg font-semibold">Dissertatsiyani tahrirlash</h4>
                </div>
                <div class="p-6">
                <form action="{{ route('dissertations.update', $dissertation->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-5">
                        <label for="title" class="block text-sm font-medium text-gray-700">Sarlavha</label>
                        <input
                            type="text"
                            name="title"
                            id="title"
                            class="mt-1 block w-full rounded-md  shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('title') border-red-500 @enderror"
                            value="{{ old('title', $dissertation->title) }}"
                            required
                        >
                        @error('title')
                            <p class="text-sm text-red-500 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label for="content" class="block text-sm font-medium text-gray-700">Dissertatsiya matni</label>
                        <textarea
                            name="content"
                            id="content"
                            rows="10"
                            class="mt-1 block w-full rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('content') border-red-500 @enderror"
                            required
                        >{{ old('content', $dissertation->content) }}</textarea>
                        @error('content')
                            <p class="text-sm text-red-500 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label for="image" class="block text-sm font-medium text-gray-700">Rasmni yuklang</label>
                        <input
                            type="file"
                            name="image"
                            id="image"
                            class="mt-1 block w-full rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('image') border-red-500 @enderror"
                            accept="image/*"
                        >
                        @if ($dissertation->image)
                            <p class="text-sm text-gray-500 mt-2">Joriy rasm: <a href="{{ asset('storage/' . $dissertation->image) }}" target="_blank" class="text-blue-600 hover:underline">Ko'rish</a></p>
                        @endif
                        @error('image')
                            <p class="text-sm text-red-500 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label for="pdf" class="block text-sm font-medium text-gray-700">PDFni yuklang</label>
                        <input
                            type="file"
                            name="pdf"
                            id="pdf"
                            class="mt-1 block w-full rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 @error('pdf') border-red-500 @enderror"
                            accept="application/pdf"
                        >
                        @if ($dissertation->pdf)
                            <p class="text-sm text-gray-500 mt-2">Joriy PDF: <a href="{{ asset('storage/' . $dissertation->pdf) }}" target="_blank" class="text-blue-600 hover:underline">Ko'rish</a></p>
                        @endif
                        @error('pdf')
                            <p class="text-sm text-red-500 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-between items-center">
                        <a href="{{ route('dashboard') }}" class="text-blue-600 hover:underline">Bekor qilish</a>
                        <button type="submit" class="px-4 py-2 bg-blue-600 text-white font-medium rounded-md hover:bg-blue-700">
                            Saqlash
                        </button>
                    </div>
                </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
