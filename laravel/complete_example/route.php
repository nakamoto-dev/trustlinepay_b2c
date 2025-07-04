<?php

// routes/web.php

use App\Http\Controllers\TrustlinePageController;

Route::get('/trustline-demo', [TrustlinePageController::class, 'form']);
Route::post('/trustline-demo/send', [TrustlinePageController::class, 'send'])->name('trustline.send');
