<?php
use Illuminate\Support\Facades\Route;
use App\Forms\Http\Controllers\FormController;
use App\Forms\Http\Controllers\ResponsesController;
use App\Subscriptions\Http\Controllers\PricingsController;
use Illuminate\Http\Request;
use App\Subscriptions\Http\Controllers\SubscriptionsController;
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
    return redirect(route('admin.dashboard.index'));
});

Route::get('/admin', function () {
    return redirect(route('admin.dashboard.index'));
})->name('admin');

Route::get('/billing-portal', function (Request $request) {
   return $request->user()->redirectToBillingPortal(route('pricing'));
});

Route::resource('pricing/{pricing}/subscriptions', SubscriptionsController::class)->middleware('auth');
Route::get('subscriptions/success', [SubscriptionsController::class, 'success'])->middleware('auth')->name('subscriptions.success');
Route::get('subscriptions/cancel', [SubscriptionsController::class, 'cancel'])->middleware('auth')->name('subscriptions.cancel');;

Route::get('/f/{slugFormId}', [ResponsesController::class, 'create'])->name('forms.responses.create');
Route::post('/f/{slugFormId}', [ResponsesController::class, 'store'])->name('forms.responses.store');
Route::get('/f/{slugFormId}/{response}', [ResponsesController::class, 'edit'])->name('forms.responses.edit');
Route::put('/f/{slugFormId}/{response}', [ResponsesController::class, 'update'])->name('forms.responses.update');
Route::get('/thankyou/{slugFormId}/{response}', [FormController::class, 'thankyou'])->name('forms.thankyou');
Route::get('/pricing', [PricingsController::class, 'pricing'])->name('pricing');

// mockup
//Route::get('/pricing', function () {
//    return view('mockup.pricing');
//});

Route::get('/users-index', function () {
    return view('mockup.users');
});
Route::get('/users-show', function () {
    return view('mockup.users-show');
});
Route::get('/users-add', function () {
    return view('mockup.users-add');
});
Route::get('/users-edit', function () {
    return view('mockup.users-edit');
});

Route::get('/packages-index', function () {
    return view('mockup.packages');
});
Route::get('/packages-add', function () {
    return view('mockup.packages-add');
});
Route::get('/packages-edit', function () {
    return view('mockup.packages-edit');
});



Route::get('/invoices', function () {
    return view('mockup.invoices');
});


//Route::get('/subscription', function () {
//    return view('mockup.subscription');
//});
