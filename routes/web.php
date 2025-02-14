<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmailAccountController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function(){

    Route::get('/dashboard', [EmailAccountController::class, 'dashboard'])->name('dashboard');

    Route::get('inbox', [EmailAccountController::class, 'inbox'])->name('inbox');

    Route::get('/send-email', [EmailAccountController::class, 'inbox'])->name('send.email.form');

    // Route::post('/send-email', function (Request $request) {
    //     $request->validate([
    //         'to'      => 'required|email',
    //         'subject' => 'required|string',
    //         'body'    => 'required|string',
    //     ]);
    
    //     Mail::raw($request->body, function ($message) use ($request) {
    //         $message->to($request->to)
    //                 ->subject($request->subject);
    //     });
    
    //     return response()->json(['message' => 'Email sent successfully']);
    // })->name('send.email.action');

    Route::post('post-email', [EmailAccountController::class, 'sendEmail'])->name('post.email');
    
    Route::post('/create-email', [EmailAccountController::class, 'createEmail']);
    Route::get('/fetch-emails/{email}', [EmailAccountController::class, 'fetchEmails']);
    Route::post('/send-email', function (Request $request) {
        return app(EmailAccountController::class)->sendEmail($request);
    });
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
