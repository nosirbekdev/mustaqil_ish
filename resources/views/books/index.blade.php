@extends('layouts.app')

@section('title', 'Kitoblar')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="flex justify-between items-center mb-5">
    <h1 class="text-2xl font-semibold mb-4">Kitoblar</h1>
    <a href="{{ route('books.create') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Kitob qo'shish</a>
    </div>
    <table class="min-w-full bg-white shadow-md rounded-lg">
        <thead>
            <tr>
                <th class="p-4 text-left">Sarlavha</th>
                <th class="p-4 text-left">Muallif</th>
                <th class="p-4 text-left">Amallar</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($books as $book)
                <tr>
                    <td class="p-4">{{ $book->title }}</td>
                    <td class="p-4">{{ $book->author }}</td>
                    <td class="p-4">
                        <a href="{{ route('books.show', $book->id) }}" class="text-blue-500">Ko'rish</a> |
                        <a href="{{ route('books.edit', $book->id) }}" class="text-green-500">Tahrirlash</a> |
                        <form action="{{ route('books.destroy', $book->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500">O'chirish</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $books->links() }}
    </div>
</div>
@endsection
