<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PomodoroController;
use App\Models\Pomodoro;
use App\Models\Timer;

Route::get('/', function () {
    return view('pomodoro.login');
})->name('login');

Route::get('/login', function () {
    return view('pomodoro.login');
})->name('login');

Route::get('/cadastro', function () {
    return view('pomodoro.cadastro');
});

Route::post('/login_user', [PomodoroController::class, 'login_user'])->name('login_user');
Route::post('/cadastrar_user', [PomodoroController::class, 'cadastrar_user'])->name('cadastrar_user');

Route::middleware(['auth'])->group(function () {

    Route::get('/index', function () {
        $pomo = Pomodoro::where('user_id', Auth::user()->id)->get();
        return view('pomodoro.index', ['pomo' => $pomo]);
    })->name('index');

    Route::get('/timer/{id}', function () {
        $timer = Timer::where('user_id', Auth::user()->id)->get();
        $pomo = Pomodoro::where('user_id', Auth::user()->id)->get();
        return view('pomodoro.timer', ['timer' => $timer, 'pomo' => $pomo]);
    });

    Route::get('/apagar_time/{id}', [PomodoroController::class, 'apagar_time'])->name('apagar_time');
    Route::get('/apagar_pomo/{id}', [PomodoroController::class, 'apagar_pomo'])->name('apagar_pomo');
    Route::post('/timer_form', [PomodoroController::class, 'timer_form'])->name('timer_form');
    Route::post('/save_data', [PomodoroController::class, 'saveMysql'])->name('save_data');
    Route::post('/start_check', [PomodoroController::class, 'checkStart'])->name('start_check');
    Route::post('/stop_check', [PomodoroController::class, 'checkStop'])->name('stop_check');
    Route::post('/reset_check', [PomodoroController::class, 'checkReset'])->name('reset_check');
    Route::post('/logout', [PomodoroController::class, 'logout'])->name('logout');
});
