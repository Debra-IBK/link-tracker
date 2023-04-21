<?php

use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LinkController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('links/create ');
// });

Route::get('/', [App\Http\Controllers\LinkController::class, 'index']);

Route::get('/dashboard', [App\Http\Controllers\LinkController::class, 'index']);

Route::post('/', function (Request $request) {
    $request->validate([
        'url' => 'required|url',
    ]);
    
    $link = new App\Models\Link();
    $link->url = $request->input('url');
    $link->code = Str::random(6);
    $link->save();

    return redirect('/');
});

Route::get('/{code}', function ($code) {
    $link = Link::where('code', $code)->firstOrFail();
    $link->incrementClicks();
    return redirect($link->url);
});





