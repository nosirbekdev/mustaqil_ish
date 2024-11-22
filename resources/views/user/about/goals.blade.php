<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Goals</title>
      @vite('resources/css/app.css')
</head>
<body>
@include('components.header')
<main class="bg-white pb-20">

<x-breadcrumb
    title="Loyihaning maqsad va vazifalari"
    :breadcrumbs="[
        ['label' => 'Asosiy sahifa', 'url' => '/'],
        ['label' => 'Loyiha haqida', 'url' => '/user/about/goals'],
        ['label' => 'Loyihaning maqsad va vazifalari', 'url' => null],
    ]"
/>



    <div class="container mx-auto mt-8 p-6 bg-white shadow-lg rounded-lg max-w-6xl ">
    <h2 class="text-3xl font-serif text-gray-800 mb-4">Loyihaning maqsadi va vazifalari quyidagilardan iborat:</h2>
        <p class="text-gray-700 mb-4">
            O’zbek va jahon adabiyotshunosligida qiyosiy adabiyotshunoslik bo’yicha amalga oshirilgan tadqiqotlar,
            fanni o’zlashtirishga oid barcha materiallarni o’zida jamlagan “Komparativistika” (Comparative) elektron platformasini yaratish.
            Ushbu loyiha maqsadii amalga oshirish uchun ilmiy jamoa oldiga quyidagi vazifalar qo’yilgan:
        </p>
        <ul class="list-decimal list-inside space-y-3 text-gray-700 leading-relaxed">
            <li>
                “Komparativistika” (Comparative) elektron platformasi uchun ilmiy va badiiy manbalarni yig’ish.
                Jumladan, R.J.Clemens, Pierre Brunel, Claude Pichois, André – Michel Rousseau kabi olimlarning turli til va adabiyotshunoslik asarlarini platformaga yuklash.
            </li>
            <li>Qiyosiy adabiyotshunoslik darsligini yaratish va platformaga joylash.</li>
            <li>Dissertatsiyalarni jamlash va DJVU formatda platformaga yuklash.</li>
            <li>
                Dunyo miqyosidagi Peter Szondi Institute of Comparative Literature kabi ilmiy markazlar bilan hamkorlik qilish.
            </li>
        </ul>
    </div>
</main>
@include('components.footer')
</body>
</html>
