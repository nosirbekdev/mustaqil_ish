<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>"KOMPARATIVISTIKA" JURNALI</title>
    @vite('resources/css/app.css')
</head>
<body>
@include('components.header')
<main class="bg-white">
<x-breadcrumb
    title="KOMPARATIVISTIKA JURNALI"
    :breadcrumbs="[
        ['label' => 'Asosiy sahifa', 'url' => '/'],
        ['label' => 'KOMPARATIVISTIKA JURNALI', 'url' => null],
    ]"
/>

<x-book-list :books="config('books.maqola')" />
<x-book-list :books="config('books.books')" />

</main>
@include('components.footer')


</body>
</html>
