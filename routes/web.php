<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\DissertationController;
use App\Http\Controllers\AvtoreferatController;
use App\Http\Controllers\MonographController;
use App\Http\Controllers\EuropeController;
use App\Http\Controllers\AmericanController;
use App\Http\Controllers\TurkishController;
use App\Http\Controllers\RussiaController;
use App\Http\Controllers\AsiaController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\ContactController;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/user/about/books', [BookController::class, 'books'])->name('books.index');

Route::get('/user/about/goals', [RouteController::class, 'goals'])->name('user.about.goals');
Route::get('/user/about/participants', [RouteController::class, 'participants'])->name('user.about.participants');
Route::get('/user/about/books', [RouteController::class, 'books'])->name('user.about.books');
Route::get('/user/about/articles', [RouteController::class, 'articles'])->name('user.about.articles');
Route::get('/user/scientific/dissertations', [RouteController::class, 'dissertations'])->name('user.about.dissertations');
Route::get('/user/scientific/abstracts', [RouteController::class, 'abstracts'])->name('user.about.abstracts');
Route::get('/user/scientific/monographs', [RouteController::class, 'monographs'])->name('user.about.monographs');
Route::get('/user/scientific/articles', [RouteController::class, 'articlesScientific'])->name('user.about.articlesScientific');
Route::get('/user/magazines/yevropa', [RouteController::class, 'yevropa'])->name('user.magazines.yevropa');
Route::get('/user/magazines/turkiya', [RouteController::class, 'turkiya'])->name('user.magazines.turkiya');
Route::get('/user/magazines/rossiya', [RouteController::class, 'russia'])->name('user.magazines.russia');
Route::get('/user/magazines/amerika', [RouteController::class, 'amerika'])->name('user.magazines.amerika');
Route::get('/user/magazines/centralasia', [RouteController::class, 'centralasia'])->name('user.magazines.centralasia');
Route::get('/user/literature/textbooks', [RouteController::class, 'textbooks'])->name('user.literature.textbooks');
Route::get('/user/literature/manuals', [RouteController::class, 'manuals'])->name('user.literature.manuals');
Route::get('/user/gallery/photos', [RouteController::class, 'photos'])->name('user.gallery.photos');

Route::get('/journal', [RouteController::class, 'journal'])->name('journal');
Route::get('/contact', [RouteController::class, 'contact'])->name('contact');
Route::get('/contacts', [ContactController::class, 'index'])->name('contacts.index');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('books', BookController::class);
    Route::resource('photos', PhotoController::class);
});


// Kitoblar
Route::get('/books', [BookController::class, 'bookIndex'])->name('books.index');
Route::get('/books/create', [BookController::class, 'create'])->name('books.create');
Route::post('/books', [BookController::class, 'store'])->name('books.store');
Route::get('/books/{book}', [BookController::class, 'show'])->name('books.show');
Route::delete('/books/{book}', [BookController::class, 'destroy'])->name('books.destroy');
Route::get('/books/{book}/edit', [BookController::class, 'edit'])->name('books.edit');
Route::put('/books/{book}', [BookController::class, 'update'])->name('books.update');

// photos
Route::get('/photos', [PhotoController::class, 'photoIndex'])->name('photos.index');
Route::get('/photos/create', [PhotoController::class, 'create'])->name('photos.create');
Route::post('/photos', [PhotoController::class, 'store'])->name('photos.store');
Route::get('/photos/{photo}', [PhotoController::class, 'show'])->name('photos.show');
Route::delete('/photos/{photo}', [PhotoController::class, 'destroy'])->name('photos.destroy');
Route::get('/photos/{photo}/edit', [PhotoController::class, 'edit'])->name('photos.edit');
Route::put('/photos/{photo}', [PhotoController::class, 'update'])->name('photos.update');

// dissertations
Route::get('dissertations/create', [DissertationController::class, 'create'])->name('dissertations.create');
Route::post('dissertations', [DissertationController::class, 'store'])->name('dissertations.store');
Route::get('dissertations/{id}', [DissertationController::class, 'show'])->name('dissertations.show');
Route::get('dissertations/{id}/edit', [DissertationController::class, 'edit'])->name('dissertations.edit');
Route::put('dissertations/{id}', [DissertationController::class, 'update'])->name('dissertations.update');
Route::delete('dissertations/{id}', [DissertationController::class, 'destroy'])->name('dissertations.destroy');

// Avtoreferatlar
Route::get('abstracts/create', [AvtoreferatController::class, 'create'])->name('abstracts.create');
Route::post('abstracts', [AvtoreferatController::class, 'store'])->name('abstracts.store');
Route::get('abstracts/{id}', [AvtoreferatController::class, 'show'])->name('abstracts.show');
Route::get('abstracts/{id}/edit', [AvtoreferatController::class, 'edit'])->name('abstracts.edit');
Route::put('abstracts/{id}', [AvtoreferatController::class, 'update'])->name('abstracts.update');
Route::delete('abstracts/{id}', [AvtoreferatController::class, 'destroy'])->name('abstracts.destroy');

// Monografiyalar
Route::get('monographs/create', [MonographController::class, 'create'])->name('monographs.create');
Route::post('monographs', [MonographController::class, 'store'])->name('monographs.store');
Route::get('monographs/{id}', [MonographController::class, 'show'])->name('monographs.show');
Route::get('monographs/{id}/edit', [MonographController::class, 'edit'])->name('monographs.edit');
Route::put('monographs/{id}', [MonographController::class, 'update'])->name('monographs.update');
Route::delete('monographs/{id}', [MonographController::class, 'destroy'])->name('monographs.destroy');

// Europes
Route::get('europes/create', [EuropeController::class, 'create'])->name('europes.create');
Route::post('europes', [EuropeController::class, 'store'])->name('europes.store');
Route::get('europes/{id}', [EuropeController::class, 'show'])->name('europes.show');
Route::get('europes/{id}/edit', [EuropeController::class, 'edit'])->name('europes.edit');
Route::put('europes/{id}', [EuropeController::class, 'update'])->name('europes.update');
Route::delete('europes/{id}', [EuropeController::class, 'destroy'])->name('europes.destroy');

// Americans
Route::get('americans/create', [AmericanController::class, 'create'])->name('americans.create');
Route::post('americans', [AmericanController::class, 'store'])->name('americans.store');
Route::get('americans/{id}', [AmericanController::class, 'show'])->name('americans.show');
Route::get('americans/{id}/edit', [AmericanController::class, 'edit'])->name('americans.edit');
Route::put('americans/{id}', [AmericanController::class, 'update'])->name('americans.update');
Route::delete('americans/{id}', [AmericanController::class, 'destroy'])->name('americans.destroy');

// Turkiya
Route::get('turkishes/create', [TurkishController::class, 'create'])->name('turkishes.create');
Route::post('turkishes', [TurkishController::class, 'store'])->name('turkishes.store');
Route::get('turkishes/{id}', [TurkishController::class, 'show'])->name('turkishes.show');
Route::get('turkishes/{id}/edit', [TurkishController::class, 'edit'])->name('turkishes.edit');
Route::put('turkishes/{id}', [TurkishController::class, 'update'])->name('turkishes.update');
Route::delete('turkishes/{id}', [TurkishController::class, 'destroy'])->name('turkishes.destroy');

// Russia
Route::get('russia/create', [RussiaController::class, 'create'])->name('russia.create');
Route::post('russia', [RussiaController::class, 'store'])->name('russia.store');
Route::get('russia/{id}', [RussiaController::class, 'show'])->name('russia.show');
Route::get('russia/{id}/edit', [RussiaController::class, 'edit'])->name('russia.edit');
Route::put('russia/{id}', [RussiaController::class, 'update'])->name('russia.update');
Route::delete('russia/{id}', [RussiaController::class, 'destroy'])->name('russia.destroy');

// Asia
Route::get('asia/create', [AsiaController::class, 'create'])->name('asia.create');
Route::post('asia', [AsiaController::class, 'store'])->name('asia.store');
Route::get('asia/{id}', [AsiaController::class, 'show'])->name('asia.show');
Route::get('asia/{id}/edit', [AsiaController::class, 'edit'])->name('asia.edit');
Route::put('asia/{id}', [AsiaController::class, 'update'])->name('asia.update');
Route::delete('asia/{id}', [AsiaController::class, 'destroy'])->name('asia.destroy');

// Journal
Route::get('journal/create', [JournalController::class, 'create'])->name('journal.create');
Route::post('journal', [JournalController::class, 'store'])->name('journal.store');
Route::get('journal/{id}', [JournalController::class, 'show'])->name('journal.show');
Route::get('journals/{id}/edit', [JournalController::class, 'edit'])->name('journals.edit');
Route::put('journal/{id}', [JournalController::class, 'update'])->name('journal.update');
Route::delete('journal/{id}', [JournalController::class, 'destroy'])->name('journal.destroy');

// contacts
Route::get('contacts', [ContactController::class, 'index'])->name('contacts.index');
Route::get('contacts/create', [ContactController::class, 'create'])->name('contacts.create');
Route::post('contacts', [ContactController::class, 'store'])->name('contacts.store');
Route::delete('/contacts/{id}', [ContactController::class, 'destroy'])->name('contacts.destroy');



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
    Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
    Route::get('/articles/{id}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
    Route::put('/articles/{id}', [ArticleController::class, 'update'])->name('articles.update');

});

Route::middleware('auth')->group(function () {
    // Admin va foydalanuvchilar uchun maqolalarni ko'rsatish
    Route::get('dashboard', [ArticleController::class, 'index'])->name('dashboard');

    // Maqolani o'chirish
    Route::delete('articles/{id}', [ArticleController::class, 'destroy'])->name('articles.destroy');

    Route::get('/articles/{id}', [ArticleController::class, 'show'])->name('articles.show');


    // Admin uchun maqolani tasdiqlash
    Route::post('articles/{id}/approve', [ArticleController::class, 'approve'])->name('articles.approve');
    Route::post('dissertations/{id}/approve', [DissertationController::class, 'approve'])->name('dissertations.approve');
    Route::post('abstracts/{id}/approve', [AvtoreferatController::class, 'approve'])->name('abstracts.approve');
    Route::post('monographs/{id}/approve', [MonographController::class, 'approve'])->name('monographs.approve');
    Route::post('europes/{id}/approve', [EuropeController::class, 'approve'])->name('europes.approve');
    Route::post('americans/{id}/approve', [AmericanController::class, 'approve'])->name('americans.approve');
    Route::post('turkishes/{id}/approve', [TurkishController::class, 'approve'])->name('turkishes.approve');
    Route::post('russia/{id}/approve', [RussiaController::class, 'approve'])->name('russia.approve');
    Route::post('asia/{id}/approve', [AsiaController::class, 'approve'])->name('asia.approve');
    Route::post('journal/{id}/approve', [JournalController::class, 'approve'])->name('journal.approve');
});

Route::middleware(['auth'])->group(function () {
    // Maqolalarni ko'rish
    Route::resource('articles', ArticleController::class);
    Route::resource('dissertations', DissertationController::class);
    Route::resource('abstracts', AvtoreferatController::class);
    Route::resource('monographs', MonographController::class);
    Route::resource('europe', EuropeController::class);
    Route::resource('american', AmericanController::class);
    Route::resource('turkish', TurkishController::class);
    Route::resource('russia', RussiaController::class);
    Route::resource('asia', AsiaController::class);
    Route::resource('journals', JournalController::class);


    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});



require __DIR__.'/auth.php';
