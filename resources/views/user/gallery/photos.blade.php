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

<x-book-list :books="config('books.maqola')" />

</main>
@include('components.footer')
</body>
</html>
