@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <div class="flex justify-between items-center">
    <h1 class="text-3xl font-bold text-center mb-6">Fotolavhalar</h1>
    <a href="{{ route('photos.create') }}" class="btn bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 mb-6 inline-block">
        Yangi fotolavha qo'shish
    </a>
    </div>

    @if($photos->isNotEmpty()) <!-- Check if there are photos -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
        @foreach($photos as $photo)
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <img src="{{ asset('storage/' . $photo->image) }}" alt="{{ $photo->title }}" class="w-full h-64 object-cover">
                <div class="p-4">
                    <h5 class="text-xl font-semibold text-gray-800">{{ $photo->title }}</h5>
                    <div class="mt-3 flex justify-between items-center">
                        <a href="{{ route('photos.edit', $photo) }}" class="btn bg-yellow-500 text-white py-1 px-4 rounded hover:bg-yellow-600">
                            Tahrirlash
                        </a>
                        <form action="{{ route('photos.destroy', $photo) }}" method="POST" style="display: inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn bg-red-500 text-white py-1 px-4 rounded hover:bg-red-600">
                                O'chirish
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @else
    <p class="text-center text-lg">Hech qanday fotolavhalar mavjud emas.</p>
    @endif
</div>
@endsection
