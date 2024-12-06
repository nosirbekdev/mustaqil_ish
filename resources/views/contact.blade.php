<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aloqa</title>
    @vite('resources/css/app.css')
    <script>
        // Success notification disappear after 2 seconds
        window.onload = function() {
            setTimeout(function() {
                const notification = document.getElementById('success-notification');
                if (notification) {
                    notification.style.display = 'none';
                }
            }, 2000); // 2 seconds
        }
    </script>
</head>
<body>
@include('components.header')
<main class="bg-white pb-10">

<x-breadcrumb
    title="Aloqa"
    :breadcrumbs="[
        ['label' => 'Asosiy sahifa', 'url' => '/'],
        ['label' => 'Aloqa', 'url' => '/contact'],
    ]"
/>

<section class="text-gray-600 body-font relative">
    <div class="absolute inset-0 bg-gray-300">
        <iframe width="100%" height="100%" frameborder="0" marginheight="0" marginwidth="0" title="map" scrolling="no" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d95544.78299707474!2d60.5406722532835!3d41.55248020599063!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x41dfc9284eafb523%3A0xffaf4382f65d7b61!2sUrgench%2C%20Xorazm%20Region%2C%20Uzbekistan!5e0!3m2!1sen!2s!4v1732232235467!5m2!1sen!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
    <div class="container px-5 py-24 mx-auto flex">
        <div class="lg:w-1/3 md:w-1/2 bg-white rounded-lg p-8 flex flex-col md:ml-auto w-full mt-10 md:mt-0 relative z-10 shadow-md">
            @if (session('success'))
                <div id="success-notification" class="p-4 mb-4 text-white bg-green-500 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('contacts.store') }}" method="POST">
                @csrf

                <div class="relative mb-4">
                    <label for="name" class="leading-7 text-sm text-gray-600">F.I.O</label>
                    <input type="text" id="name" name="name" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" required>
                </div>

                <div class="relative mb-4">
                    <label for="email" class="leading-7 text-sm text-gray-600">Email</label>
                    <input type="email" id="email" name="email" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out" required>
                </div>

                <div class="relative mb-4">
                    <label for="message" class="leading-7 text-sm text-gray-600">Xabar</label>
                    <textarea id="message" name="message" class="w-full bg-white rounded border border-gray-300 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out" required></textarea>
                </div>

                <button type="submit" class="text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded text-lg">Yuborish</button>
            </form>
        </div>
    </div>
</section>

</main>
@include('components.footer')
</body>
</html>
