<?php

use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\CommentController as AdminCommentController;
use App\Http\Controllers\Admin\ContentPageController as AdminContentPageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DoctorController as AdminDoctorController;
use App\Http\Controllers\Admin\HospitalController as AdminHospitalController;
use App\Http\Controllers\Admin\InfographicController as AdminInfographicController;
use App\Http\Controllers\Admin\MediaController as AdminMediaController;
use App\Http\Controllers\Admin\VideoController as AdminVideoController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CalculatorController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\InfographicController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RubricController;
use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| FRONTEND - Portal Berita Healthcare.id
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/rubrik/{slug}', [RubricController::class, 'show'])->name('rubrics.show');
Route::get('/video', [VideoController::class, 'index'])->name('videos.index');
Route::get('/video/{slug}', [VideoController::class, 'show'])->name('videos.show');
Route::get('/pages/{slug}', [PageController::class, 'show'])->name('pages.show');
Route::get('/about-us', [PageController::class, 'show'])->defaults('slug', 'about')->name('pages.about');
Route::get('/advertise', [PageController::class, 'show'])->defaults('slug', 'advertise')->name('pages.advertise');
Route::get('/magazine', [PageController::class, 'show'])->defaults('slug', 'magazine')->name('pages.magazine');
Route::get('/contact-us', [PageController::class, 'show'])->defaults('slug', 'contact')->name('pages.contact');
Route::get('/privacy-policy', [PageController::class, 'show'])->defaults('slug', 'privacy-policy')->name('pages.privacy');
Route::get('/event-promotion', [PageController::class, 'show'])->defaults('slug', 'event-promotion')->name('pages.events');

Route::prefix('berita')->name('news.')->group(function () {
    Route::get('/', [ArticleController::class, 'index'])->name('index');
    Route::get('/kategori/{slug}', [ArticleController::class, 'byCategory'])->name('category');
    Route::get('/{slug}', [ArticleController::class, 'show'])->name('show');
    Route::post('/{article}/komentar', [ArticleController::class, 'storeComment'])->name('comment.store');
});

Route::prefix('rumah-sakit')->name('hospitals.')->group(function () {
    Route::get('/', [HospitalController::class, 'index'])->name('index');
    Route::get('/{slug}', [HospitalController::class, 'show'])->name('show');
});

Route::prefix('dokter')->name('doctors.')->group(function () {
    Route::get('/', [DoctorController::class, 'index'])->name('index');
    Route::get('/{slug}', [DoctorController::class, 'show'])->name('show');
});

Route::prefix('infografis')->name('infographics.')->group(function () {
    Route::get('/', [InfographicController::class, 'index'])->name('index');
    Route::get('/{slug}', [InfographicController::class, 'show'])->name('show');
});

Route::get('/kalkulator-kesehatan', [CalculatorController::class, 'index'])->name('calculator');

Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);
});
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

/*
|--------------------------------------------------------------------------
| ADMIN PANEL - Tampilan ala TailAdmin
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->name('admin.')->middleware(['auth', 'role:super_admin,editor,author'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::post('berita/upload-gambar', [AdminArticleController::class, 'uploadEditorImage'])
        ->name('articles.upload-image');
    Route::get('berita/{article}/preview', [AdminArticleController::class, 'preview'])
        ->name('articles.preview');
    Route::post('berita/{article}/submit-review', [AdminArticleController::class, 'submitForReview'])
        ->name('articles.submit-review');
    Route::middleware('role:super_admin,editor')->group(function () {
        Route::resource('halaman', AdminContentPageController::class)
            ->only(['index', 'edit', 'update'])
            ->parameters(['halaman' => 'contentPage'])
            ->names('pages');
        Route::get('media', [AdminMediaController::class, 'index'])->name('media.index');
        Route::delete('media/{path}', [AdminMediaController::class, 'destroy'])->where('path', '.*')->name('media.destroy');
        Route::resource('video', AdminVideoController::class)->names('videos');
        Route::post('berita/{article}/publish', [AdminArticleController::class, 'publish'])->name('articles.publish');
        Route::post('berita/{article}/schedule', [AdminArticleController::class, 'schedule'])->name('articles.schedule');
        Route::post('berita/{article}/reject', [AdminArticleController::class, 'reject'])->name('articles.reject');
        Route::post('berita/{article}/archive', [AdminArticleController::class, 'archive'])->name('articles.archive');
    });
    Route::resource('berita', AdminArticleController::class)
        ->parameters(['berita' => 'article'])
        ->names('articles');

    // Modul berikut khusus editor & super_admin
    Route::middleware('role:super_admin,editor')->group(function () {
        Route::resource('kategori', AdminCategoryController::class)
            ->parameters(['kategori' => 'category'])
            ->names('categories');
        Route::resource('rumah-sakit', AdminHospitalController::class)
            ->parameters(['rumah-sakit' => 'hospital'])
            ->names('hospitals');
        Route::resource('dokter', AdminDoctorController::class)
            ->parameters(['dokter' => 'doctor'])
            ->names('doctors');
        Route::resource('infografis', AdminInfographicController::class)
            ->parameters(['infografis' => 'infographic'])
            ->names('infographics');

        Route::get('komentar', [AdminCommentController::class, 'index'])->name('comments.index');
        Route::patch('komentar/{comment}', [AdminCommentController::class, 'updateStatus'])->name('comments.update-status');
        Route::delete('komentar/{comment}', [AdminCommentController::class, 'destroy'])->name('comments.destroy');
    });

    // Manajemen pengguna khusus super_admin
    Route::middleware('role:super_admin')->group(function () {
        Route::resource('pengguna', AdminUserController::class)
            ->parameters(['pengguna' => 'user'])
            ->names('users');
    });
});
