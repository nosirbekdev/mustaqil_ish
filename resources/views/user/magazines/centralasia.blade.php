<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Markaziy Osiyo</title>
      @vite('resources/css/app.css')
</head>
<body>
@include('components.header')
<main class="bg-white pb-20">

<x-breadcrumb
    title="Markaziy Osiyo"
    :breadcrumbs="[
        ['label' => 'Asosiy sahifa', 'url' => '/'],
        ['label' => 'Ilmiy jurnallar', 'url' => '/user/magazines/centralasia'],
        ['label' => 'Markaziy Osiyo', 'url' => null],
    ]"
/>

<x-book-list :books="$asias" />

</main>
@include('components.footer')
</body>
</html>
