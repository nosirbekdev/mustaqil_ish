@extends('layouts.app')


@section('content')
<style>
/* Rainbow badge uchun */
.animate-rainbow {
    background: linear-gradient(90deg, red, orange, yellow, green, blue, indigo, violet);
    background-size: 400% 400%;
    animation: rainbow 3s infinite;
}

@keyframes rainbow {
    0% {
        background-position: 0% 50%;
    }
    50% {
        background-position: 100% 50%;
    }
    100% {
        background-position: 0% 50%;
    }
}
</style>

    <div class="container">
        <h1 class="text-2xl font-bold mb-4">Murojaatlar</h1>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($contacts as $contact)
                <div class="relative bg-white shadow rounded p-4 space-y-2">
                    <!-- Yangi badge -->
                    @if (!$contact->is_read)
                        <span class="absolute top-2 right-2 px-2 py-1 text-xs font-bold text-white rounded-full animate-rainbow">
                            Yangi
                        </span>
                    @endif

                    <h2 class="text-lg font-semibold">{{ $contact->name }}</h2>
                    <p><strong>Email:</strong> {{ $contact->email }}</p>
                    <p><strong>Xabar:</strong> {{ Str::limit($contact->message, 100, '...') }}</p>
                    <button onclick="openModal('{{ $contact->message }}')"
                            class="text-blue-500 hover:underline">Batafsil</button>
                    <p class="text-sm text-gray-500">{{ $contact->created_at->diffForHumans() }}</p>

                    <!-- O'qildi yoki O'chirish tugmasi -->
                    @if (!$contact->is_read)
                        <form action="{{ route('contacts.markAsRead', $contact->id) }}" method="POST" class="mt-2">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-md w-full">O‘qildi</button>
                        </form>
                    @else
                        <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" class="mt-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded-md w-full">O‘chirish</button>
                        </form>
                    @endif
                </div>
            @endforeach
        </div>

        <!-- Modal -->
        <div id="messageModal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex justify-center items-center">
            <div class="bg-white p-6 rounded shadow-lg max-w-md w-full">
                <h2 class="text-xl font-bold mb-4">Xabar</h2>
                <p id="fullMessage" class="text-gray-700"></p>
                <button onclick="closeModal()"
                        class="mt-4 bg-red-600 text-white px-4 py-2 rounded">Yopish</button>
            </div>
        </div>
        <div class="mt-6">
            {{ $contacts->links() }}
        </div>
    </div>

    <script>
        function openModal(message) {
            document.getElementById('fullMessage').innerText = message;
            document.getElementById('messageModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('messageModal').classList.add('hidden');
        }
    </script>
@endsection
