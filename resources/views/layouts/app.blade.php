<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Font Awesome kutubxonasini yuklash -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            display: flex;
            min-height: 100vh;
            margin: 0;
        }
        aside {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 250px;
            background-color: #f8f9fa;
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
            border-right: 1px solid #e9ecef;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
        }
        main {
            margin-left: 250px;
            flex-grow: 1;
            padding: 20px;
            background: #f4f6f9;
        }
        .sidebar-item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 15px;
            border-radius: 5px;
            color: #495057;
            text-decoration: none;
        }
        .sidebar-item:hover {
            background-color: #e9ecef;
            color: #212529;
        }
        .sidebar-item.active {
            background-color: #e9ecef;
            color: #212529;
        }
        .avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
        }
        .logout-button {
            margin-top: auto;
        }
    </style>
</head>
<body>
<aside>
    <!-- Foydalanuvchi haqida ma'lumot -->
    <div class="flex items-center mb-6">
        <img src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : asset('assets/default-avatar.png') }}"
             alt="Avatar"
             class="avatar mr-4">
        <div>
            <h3 class="font-semibold text-base">{{ auth()->user()->name }}</h3>
            <p class="text-sm text-gray-600">{{ auth()->user()->email }}</p>
        </div>
    </div>

    <!-- Foydalanuvchi faqat o'z avatarini va nomini ko'rishi uchun boshqa bo'limlarni yashirish -->
    @if(auth()->user()->hasRole('admin') || auth()->user()->hasRole('writer'))
        <!-- Admin va Yozuvchi uchun bo'limlar -->
        <a href="{{ route('dashboard') }}" class="sidebar-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="fas fa-home"></i> Asosiy sahifa
        </a>
        <!-- Admin bo'limlari -->
        @if(auth()->user()->hasRole('admin'))
            <a href="{{ route('books.index') }}" class="sidebar-item {{ request()->routeIs('books.index') ? 'active' : '' }}">
                <i class="fas fa-book"></i> Kitoblar
            </a>
            <a href="{{ route('photos.index') }}" class="sidebar-item {{ request()->routeIs('photos.index') ? 'active' : '' }}">
                <i class="fas fa-images"></i> Fotolavhalar
            </a>
            <a href="{{ route('videos.index') }}" class="sidebar-item {{ request()->routeIs('videos.index') ? 'active' : '' }}">
                <i class="fas fa-video"></i> Videolar
            </a>
            <a href="{{ route('admin.users.index') }}" class="sidebar-item {{ request()->routeIs('users.index') ? 'active' : '' }}">
                <i class="fas fa-users"></i> Foydalanuvchilar
            </a>
            @php
                $unreadCount = \App\Models\Contact::where('is_read', false)->count();
            @endphp
            <a href="{{ route('contacts.index') }}" class="sidebar-item {{ request()->routeIs('contacts.index') ? 'active' : '' }}">
                <i class="fas fa-envelope"></i> Murojaatlar
                @if($unreadCount > 0)
                    <span class="badge bg-red-600 text-white px-1 rounded-sm">{{ $unreadCount }}</span>
                @endif
            </a>
        @endif

        <!-- Yozuvchi uchun bo'limlar -->
        @if(!auth()->user()->hasRole('admin'))
            <a href="{{ route('articles.create') }}" class="sidebar-item {{ request()->routeIs('articles.create') ? 'active' : '' }}">
                <i class="fas fa-newspaper"></i> Maqolalar qo'shish
            </a>
        @endif

        <!-- Profilni tahrirlash -->
        <a href="{{ route('profile.edit') }}" class="sidebar-item {{ request()->routeIs('profile.edit') ? 'active' : '' }}">
            <i class="fas fa-user-edit"></i> Profilni tahrirlash
        </a>
    @endif

    <!-- Chiqish -->
    <form action="{{ route('logout') }}" method="POST" class="logout-button">
        @csrf
        <button type="submit" class="sidebar-item">
            <i class="fas fa-sign-out-alt"></i> Chiqish
        </button>
    </form>
</aside>

<main>


    @if(auth()->check())
        @if(auth()->user()->hasRole('admin'))
        @yield('content')
        @elseif(auth()->user()->hasRole('writer'))
        @yield('content')
        @else
            <p class="flex justify-center items-center h-[90vh] font-medium text-xl">Sizning so'rovingiz yuborildi admin tasdiqlasa maqola yaratishingiz mumkin.</p>
        @endif
    @else
        <p>Iltimos, tizimga kiring.</p>
    @endif
</main>

</body>
</html>
