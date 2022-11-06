<?php

use App\Http\Requests\InvitationRequest;
use App\Models\Invitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    $invitations = Invitation::all()->sortByDesc('created_at');

    return view('welcome', compact('invitations'));
});

Route::post('confirm-attend', function (InvitationRequest $request) {
    $request->validated();

    $values = $request->all();

    Invitation::create($values);

    if ($values['is_attend']) {
        return redirect('/')->with('confirm', 'Anda akan menghadiri undangan');
    }

    return redirect('/')->with('confirm', 'Anda tidak akan menghadiri undangan');
})->name('confirm');
