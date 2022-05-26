<?php

use Illuminate\Http\Request;
use Modules\Morphling\Http\Controllers\BootstrapController;


Route::get('/morphling/bootstrap', BootstrapController::class);
