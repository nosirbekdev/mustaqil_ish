@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-2xl font-bold mb-4">Murojaatlar</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($contacts as $contact)
                <div class="bg-white shadow rounded p-4 space-y-2">
                    <h2 class="text-lg font-semibold">{{ $contact->name }}</h2>
                    <p><strong>Email:</strong> {{ $contact->email }}</p>
                    <p><strong>Xabar:</strong> {{ $contact->message }}</p>
                    <p class="text-sm text-gray-500">{{ $contact->created_at->diffForHumans() }}</p>
                    <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" class="mt-2">
                @csrf
                @method('DELETE')
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md w-full">O'chirish</button>
            </form>
                </div>

            @endforeach
        </div>
    </div>
@endsection
