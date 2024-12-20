<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Yevropa</title>
      @vite('resources/css/app.css')
</head>
<body>
@include('components.header')
<main class="bg-white pb-20">

<x-breadcrumb
    title="Yevropa"
    :breadcrumbs="[
        ['label' => 'Asosiy sahifa', 'url' => '/'],
        ['label' => 'Ilmiy jurnallar', 'url' => '/user/magazines/yevropa'],
        ['label' => 'Yevropa', 'url' => null],
    ]"
/>

<x-book-list :books="$europes" />

</main>
@include('components.footer')
</body>
</html>
