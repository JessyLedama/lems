<?php

use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Http\Controllers\EmailAccountController;

Route::post('/send-email', function (Request $request) {
    $request->validate([
        'to'      => 'required|email',
        'subject' => 'required|string',
        'body'    => 'required|string',
    ]);

    Mail::raw($request->body, function ($message) use ($request) {
        $message->to($request->to)
                ->subject($request->subject);
    });

    return response()->json(['message' => 'Email sent successfully']);
});

Route::post('/create-email', [EmailAccountController::class, 'createEmail']);
Route::get('/fetch-emails/{email}', [EmailAccountController::class, 'fetchEmails']);
Route::post('/send-email', function (Request $request) {
    return app(EmailAccountController::class)->sendEmail($request);
});

Route::get('/dashboard', function () {
    return view('dashboard');
});
