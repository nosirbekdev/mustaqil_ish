<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Font Awesome kutubxonasini yuklash -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            display: flex;
            min-height: 100vh;
        }
        aside {
            width: 250px;
            background-color: #f8f9fa;
            padding: 20px;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
            border-right: 1px solid #e9ecef;
        }
        main {
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
    </style>
</head>
<body>
    <aside class="shadow-xl">

        <!-- Foydalanuvchi haqida ma'lumot -->
        <div class="flex items-center mb-6">
            <!-- Avatar -->
            <img src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : asset('assets/default-avatar.png') }}"
                 alt="Avatar"
                 class="avatar mr-4">
            <!-- Foydalanuvchi ismi va email -->
            <div>
                <h3 class="font-semibold text-base">{{ auth()->user()->name }}</h3>
                <p class="text-sm text-gray-600">{{ auth()->user()->email }}</p>
            </div>
        </div>

        <!-- Asosiy sahifa bo'limi -->
        <a href="{{ route('dashboard') }}" class="sidebar-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
            <i class="fas fa-home"></i> Asosiy sahifa
        </a>

        <!-- Faqat oddiy foydalanuvchilar uchun "Mening maqolalarim" bo'limi -->
        @if(!auth()->user()->hasRole('admin'))
            <a href="{{ route('articles.create') }}" class="sidebar-item {{ request()->routeIs('articles.create') ? 'active' : '' }}">
                <i class="fas fa-newspaper"></i> Mening maqolalarim
            </a>
        @endif

        <!-- Chiqish -->
        <form action="{{ route('logout') }}" method="POST" class="mt-[65vh]">
            @csrf
            <button type="submit" class="sidebar-item">
                <i class="fas fa-sign-out-alt"></i> Chiqish
            </button>
        </form>
    </aside>

    <main>
        @yield('content')
    </main>
</body>
</html>
