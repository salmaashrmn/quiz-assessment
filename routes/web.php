<?php

use App\Livewire\Admin\Dashboard;
use App\Livewire\Admin\Quiz\QuestionManager;
use App\Livewire\Admin\Quiz\QuizForm;
use App\Livewire\Admin\Quiz\QuizList;
use App\Livewire\Admin\Submission\SubmissionList;
use App\Livewire\Admin\Submission\SubmissionDetail;
use App\Livewire\Public\Quiz\PublicQuizList;
use App\Livewire\Public\Quiz\QuizAttempt;
use App\Livewire\Public\Quiz\QuizDetail;
use App\Livewire\Public\Quiz\QuizResult;
use App\Http\Controllers\Admin\AuthController;
use App\Livewire\Admin\Authentication\Login;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->group(function () {

    // Guest
    Route::get('/login', Login::class)
        ->name('admin.login');

    Route::post('/login', Login::class)
        ->name('admin.login.submit');

    // Authenticated admin
    Route::middleware('auth')->group(function () {

        Route::post('/logout', [Login::class, 'logout'])
            ->name('admin.logout');

        Route::get('', Dashboard::class)
            ->name('admin.dashboard');
        
        Route::get('/quizzes', QuizList::class)
            ->name('admin.quizzes.index');
        
        Route::get('/quizzes/create', QuizForm::class)
            ->name('admin.quizzes.create');
        
        Route::get('/quizzes/{quiz}/edit', QuizForm::class)
            ->name('admin.quizzes.edit');
        
        Route::get('/quizzes/{quiz}/questions', QuestionManager::class)
            ->name('admin.quizzes.questions');
        
        Route::get('/submissions', SubmissionList::class)
            ->name('admin.submissions.index');
        
        Route::get('/submissions/{submission}', SubmissionDetail::class)
            ->name('admin.submissions.show');
    });
});

Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');

Route::post('/admin/logout', function () {
    Auth::logout();

    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect()->route('admin.login');
})->name('admin.logout');

Route::get('/quizzes', PublicQuizList::class)
    ->name('quizzes.index');

Route::get('/quizzes/{quiz}', QuizDetail::class)
    ->name('quizzes.show');

Route::get('/quizzes/{quiz}/attempt/{submission}', QuizAttempt::class)
    ->name('quizzes.attempt');

Route::get('/quizzes/{quiz}/result/{submission}', QuizResult::class)
    ->name('quizzes.result');
