<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookController;

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
});

Route::middleware(['auth'])->group(function () {
    // Maqolalarni ko'rish
    Route::resource('articles', ArticleController::class);

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});



require __DIR__.'/auth.php';
