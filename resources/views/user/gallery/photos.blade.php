<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fotolavhalar</title>
      @vite('resources/css/app.css')
</head>
<body>
@include('components.header')
<main class="bg-white">

<x-breadcrumb
    title="Fotolavhalar"
    :breadcrumbs="[
        ['label' => 'Asosiy sahifa', 'url' => '/'],
        ['label' => 'Galeriya', 'url' => '/user/gallery/photos'],
        ['label' => 'Fotolavhalar', 'url' => null],
    ]"
/>
<section class="text-gray-600 body-font">
  <div class="container px-5 py-14 max-w-6xl mx-auto">
    <div class="flex flex-wrap -m-4">
      @foreach($photos as $photo)
      <div class="p-4 md:w-1/3">
        <div class="h-full border-2 border-gray-200 border-opacity-60 rounded-lg overflow-hidden">
          <img class="lg:h-48 md:h-36 w-full object-cover object-center" src="{{ asset('storage/' . $photo->image) }}" alt="{{ $photo->title }}">
          <div class="p-6">
            <p class="leading-relaxed mb-3">{{ $photo['title'] }}</p>
          </div>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>

</main>
@include('components.footer')
</body>
</html>
