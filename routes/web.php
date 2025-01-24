<?php

use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ContactsController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ForOrganizersController;
use App\Http\Controllers\Inspector\TicketController as InspectorTicketController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\OrganizerController;
use App\Http\Controllers\Panel\Administrator\StatsController;
use App\Http\Controllers\Panel\Administrator\TicketController as AdministratorTicketController;
use App\Http\Controllers\Panel\EventController as PanelEventController;
use App\Http\Controllers\Panel\Manager\BannerController;
use App\Http\Controllers\Panel\Manager\OrganizerController as ManagerOrganizerController;
use App\Http\Controllers\Panel\Organizer\OrganizerController as OrganizerPanelOrganizerController;
use App\Http\Controllers\Panel\PanelController;
use App\Http\Controllers\PolicyController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [MainController::class, 'index'])->name('index');
Route::get('/about', [AboutUsController::class, 'index'])->name('about');
Route::get('/contacts', [ContactsController::class, 'index'])->name('contacts');
Route::get('/organizers', [OrganizerController::class, 'index'])->name('organizers.index');
Route::get('/policy', [PolicyController::class, 'index'])->name('policy');

Route::group(['middleware' => 'guest'], function() {
    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('/register', [RegisterController::class, 'store']);

    Route::get('/login', [LoginController::class, 'login'])->name('login');
    Route::post('/login', [LoginController::class, 'store']);
});

Route::group(['prefix' => 'events'], function() {
    Route::get('/', [EventController::class, 'index'])->name('event.index');
    Route::get('/{event}', [EventController::class, 'show'])->name('event.show');
});

Route::middleware('auth')->group(function() {
    Route::get('/logout', [LoginController::class, 'destroy'])->name('logout');
    Route::resource('favorites', FavoriteController::class)->only('store', 'destroy');

    Route::middleware('role:inspector')->prefix('tickets')->group(function() {
        Route::get('/{code}', [InspectorTicketController::class, 'show'])->name('tickets.show');
        Route::patch('/{code}', [InspectorTicketController::class, 'update'])->name('tickets.update');
    });

    Route::prefix('user')->group(function() {
        Route::get('/', [UserController::class, 'index'])->name('user.index');
        Route::get('/tickets/{ticket}', [TicketController::class, 'show'])->name('user.ticket.show');
        Route::patch('/tickets/{ticket}', [TicketController::class, 'update'])->name('user.ticket.update');
    });

    Route::post('/orders', [\App\Http\Controllers\OrderController::class, 'store'])->name('orders.store');

    Route::resource('/organizers', OrganizerController::class)->only(['create', 'store']);

    Route::prefix('panel')->name('panel.')->group(function() {
        Route::get('/', [PanelController::class, 'index'])->name('index');

        Route::middleware('role:organizer')->group(function() {
            Route::get('/organizer-info', [OrganizerPanelOrganizerController::class, 'index'])->name('organizer-info');
        });

        Route::middleware(['role:organizer,manager'])->group(function() {
            Route::resource('events', PanelEventController::class);
        });

        Route::middleware('role:manager')->group(function() {
            Route::resource('banners', BannerController::class);
            Route::resource('organizers', ManagerOrganizerController::class);
        });

        Route::middleware('role:administrator')->group(function() {
            Route::prefix('stats')->group(function() {
                Route::get('/', [StatsController::class, 'index'])->name('stats.index');
                Route::get('/per-days', [StatsController::class, 'statsPerDays']);
                Route::get('/by-events', [StatsController::class, 'statsByEvents']);
                Route::get('/by-organizers', [StatsController::class, 'statsByOrganizers']);
            });

            Route::prefix('tickets')->group(function() {
                Route::get('/', [AdministratorTicketController::class, 'index'])->name('tickets.index');
                Route::get('/report', [AdministratorTicketController::class, 'report'])->name('tickets.report');
            });
        });
    });
});

Route::post('/update-order', [\App\Http\Controllers\OrderController::class, 'update']);
