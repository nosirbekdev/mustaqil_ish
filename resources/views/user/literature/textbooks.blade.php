<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>O`quv qo`llanmalar</title>
      @vite('resources/css/app.css')
</head>
<body>
@include('components.header')
<main class="bg-white pb-20">

<x-breadcrumb
    title="O`quv qo`llanmalar"
    :breadcrumbs="[
        ['label' => 'Asosiy sahifa', 'url' => '/'],
        ['label' => 'O`quv qo`llanmalar', 'url' => null],
    ]"
/>

<x-book-list :books="config('books.maqola')" />

</main>
@include('components.footer')
</body>
</html>
