<div class="bg-blue-700">
  <!-- Header -->
  <div class="container mx-auto flex justify-between max-w-7xl items-center py-4 px-4 min-h-[22vh]">
    <!-- Logo va Matn -->
    <div class="flex items-center space-x-4">
      <a href="/">
      <img src="{{ asset('/assets/logo.jpeg')}}" alt="Logo" class="h-10 w-[100px] rounded-md">
      </a>
      <div class="border-l-2 border-gray-400 h-10 mx-4"></div>
      <div class="text-white">
        <h1 class="text-2xl font-bold">JavaScript vs Python <br> A Comparative Study</h1>
        <p class="text-sm font-semibold">Komparativistika platformasi</p>
      </div>
    </div>

    <!-- Kirish va Ro‘yxatdan o‘tish -->
    <div class="flex items-center space-x-4">
    @if (Auth::check())
    <a href="{{ route('dashboard') }}" class="flex items-center">
    <img src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : asset('assets/avatar.png') }}"
         alt="Avatar"
         class="avatar mr-4 w-14 h-14 ">
</a>
      @else
        <a href="/login" class="bg-blue-500 text-gray-200 px-4 py-2 rounded hover:bg-gray-300 hover:text-blue-700">Kirish</a>
        <a href="/register" class="bg-gray-200 text-blue-700 px-4 py-2 rounded hover:bg-blue-500 hover:text-gray-200">Ro‘yxatdan o‘tish</a>
      @endif
      <!-- <input type="text" placeholder="Search..." class="bg-white text-black px-4 py-2 rounded border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"> -->
    </div>
  </div>

  <!-- Navigatsiya -->
<div class="bg-[#212529]">
  <div class="container mx-auto flex items-center justify-center text-white py-2 px-4">
    @foreach (config('menus.menus') as $menu)
      @if ($menu['dropdown'])
        <!-- Dropdown menyu -->
        <div class="relative group px-3">
            @if (isset($menu['items']) && !empty($menu['items']))
        <a  class="text-white  px-4 py-2.5 hover:text-[#212529]  hover:bg-gray-200 cursor-pointer">
              {{ $menu['name'] }}
          </a>

          <!-- Dropdown menu -->
          <div id="dropdown-{{ $loop->index }}" class="z-10 absolute top-8 left-1/2 transform -translate-x-1/2 hadow-lg hidden bg-white divide-y divide-gray-100  shadow w-44 dark:bg-gray-700">
              <ul class="py-2 text-sm text-gray-700 dark:text-gray-200">
                  @foreach ($menu['items'] as $item)
                      <li>
                          <a href="{{ $item['link'] }}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                              {{ $item['name'] }}
                          </a>
                      </li>
                  @endforeach
              </ul>

          </div>
          @elseif (isset($menu['url']))
                <!-- Oddiy tugma faqat url bilan -->
                <a href="{{ $menu['url'] }}" class="text-white px-4 py-2.5 hover:text-[#212529] hover:bg-gray-200 cursor-pointer">
                    {{ $menu['name'] }}
                </a>
            @endif
        </div>
      @else
        <!-- Oddiy menyu -->
        <a  class="text-white hover:text-[#212529]  hover:bg-gray-200 cursor-pointer space-x-3 space-y-3">
              {{ $menu['name'] }}
          </a>
      @endif
    @endforeach
  </div>
</div>

<script>
  document.querySelectorAll('.group').forEach(group => {
    const dropdown = group.querySelector('.z-10');
    group.addEventListener('mouseenter', () => {
      setTimeout(() => dropdown.classList.remove('hidden'), 300);
    });
    group.addEventListener('mouseleave', () => {
      setTimeout(() => dropdown.classList.add('hidden'), 300);
    });
  });
</script>
