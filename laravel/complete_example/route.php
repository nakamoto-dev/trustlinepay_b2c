<?php

// routes/web.php

use App\Http\Controllers\TrustlinePageController;

Route::get('/pay', [TrustlinePageController::class, 'form']);
Route::post('/pay/initiate', [TrustlinePageController::class, 'send'])->name('trustline.send');
