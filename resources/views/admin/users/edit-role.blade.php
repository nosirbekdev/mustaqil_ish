@extends('layouts.app')

@section('title', 'Foydalanuvchi roli o\'zgartirish')

@section('content')
<h1 class="text-2xl font-bold mb-6">Roli o'zgartirish: {{ $user->name }}</h1>

<form action="{{ route('admin.users.update-role', $user) }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
    @csrf
    <div class="mb-4">
        <label for="role" class="block text-sm font-medium text-gray-700 mb-2">Rollar</label>
        <select name="role" id="role" required class="block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
            @foreach($roles as $role)
            <option value="{{ $role->name }}" {{ $user->roles->contains('name', $role->name) ? 'selected' : '' }}>
                {{ $role->name }}
            </option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="px-4 py-2 bg-blue-500 text-white text-sm font-medium rounded-md shadow-sm hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
        Saqlash
    </button>
</form>
@endsection
