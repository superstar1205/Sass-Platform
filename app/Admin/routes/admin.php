<?php
use App\Admin\Forms\Http\Controllers\FormsController;
use App\Admin\Homes\Http\Controllers\DashboardController;
use App\Admin\Responses\Http\Controllers\ResponsesController;
use App\Admin\Integrations\Http\Controllers\IntegrationsController;
use App\Admin\Integrations\Http\Controllers\IntegrationStatusController;
use App\Admin\Packages\Http\Controllers\PackagesController;
use App\Admin\Users\Http\Controllers\UsersController;
use App\Admin\Invoices\Http\Controllers\InvoicesController;
use App\Admin\Subscriptions\Http\Controllers\SubscriptionsController;
use App\Admin\Envs\Http\Controllers\EnvsController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminAuthorize;
use App\Http\Middleware\ShouldSubscription;
use App\Http\Middleware\StripeCanNotEmpty;
use App\Admin\Forms\Http\Controllers\UploadController;

Route::middleware(['auth', ShouldSubscription::class])
    ->name('admin.')
    ->group(function () {
        Route::resource('forms', FormsController::class);
        Route::resource('responses', ResponsesController::class);
        Route::resource('integrations', IntegrationsController::class);
        Route::resource('integration-status', IntegrationStatusController::class);
        Route::resource('invoices', InvoicesController::class)->middleware(StripeCanNotEmpty::class);
        Route::resource('subscriptions', SubscriptionsController::class);
        Route::post('subscriptions/resume/{name}', [SubscriptionsController::class, 'resume'])->name('subscriptions.resume');
        Route::resource('envs', EnvsController::class);
        Route::resource('upload', UploadController::class)->only('store');

        Route::middleware([AdminAuthorize::class, StripeCanNotEmpty::class])->group(function () {
            Route::resource('packages', PackagesController::class);
            Route::resource('users', UsersController::class);
        });

        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    });
