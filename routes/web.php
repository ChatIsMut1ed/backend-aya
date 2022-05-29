<?php

use App\Http\Controllers\ActiviteController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DeclarationController;
use App\Http\Controllers\DemandeExperController;
use App\Http\Controllers\DemandeFactureController;
use App\Http\Controllers\DemandeForagController;
use App\Http\Controllers\DescriptionSocController;
use App\Http\Controllers\DevisMatController;
use App\Http\Controllers\DevisObjController;
use App\Http\Controllers\MatsController;
use App\Http\Controllers\NotifiactionController;
use App\Http\Controllers\ObjController;
use App\Http\Controllers\VaribleChangController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::group(
    [
        'prefix' => 'activite',
        // 'middleware' => ['auth:sanctum', 'throttle:6,1', 'route_time_out'],
    ],
    function () {
        Route::get('/', [ActiviteController::class, 'index2']);
        Route::get('/all', [ActiviteController::class, 'index']);
        Route::get('/{id}', [ActiviteController::class, 'GetInstanceById']);
        Route::post('/', [ActiviteController::class, 'CreateInstance']);
        Route::put('/{id}', [ActiviteController::class, 'UpdateInstance']);
        Route::delete('/{id}', [ActiviteController::class, 'DeleteInstance']);
    }
);

Route::group(
    [
        'prefix' => 'contact',
        // 'middleware' => ['auth:sanctum', 'throttle:6,1', 'route_time_out'],
    ],
    function () {
        Route::get('/', [ContactController::class, 'index']);
        Route::get('/{id}', [ContactController::class, 'GetInstanceById']);
        Route::post('/', [ContactController::class, 'CreateInstance']);
        Route::put('/{id}', [ContactController::class, 'UpdateInstance']);
        Route::delete('/{id}', [ContactController::class, 'DeleteInstance']);
    }
);

Route::group(
    [
        'prefix' => 'declaraction',
        // 'middleware' => ['auth:sanctum', 'throttle:6,1', 'route_time_out'],
    ],
    function () {
        Route::get('/', [DeclarationController::class, 'index']);
        Route::get('/{id}', [DeclarationController::class, 'GetInstanceById']);
        Route::post('/', [DeclarationController::class, 'CreateInstance']);
        Route::put('/{id}', [DeclarationController::class, 'UpdateInstance']);
        Route::delete('/{id}', [DeclarationController::class, 'DeleteInstance']);
    }
);

Route::group(
    [
        'prefix' => 'dem-exp',
        // 'middleware' => ['auth:sanctum', 'throttle:6,1', 'route_time_out'],
    ],
    function () {
        Route::get('/', [DemandeExperController::class, 'index']);
        Route::get('/{id}', [DemandeExperController::class, 'GetInstanceById']);
        Route::post('/', [DemandeExperController::class, 'CreateInstance']);
        Route::put('/{id}', [DemandeExperController::class, 'UpdateInstance']);
        Route::delete('/{id}', [DemandeExperController::class, 'DeleteInstance']);
    }
);

Route::group(
    [
        'prefix' => 'dem-fact',
        // 'middleware' => ['auth:sanctum', 'throttle:6,1', 'route_time_out'],
    ],
    function () {
        Route::get('/', [DemandeFactureController::class, 'index']);
        Route::get('/{id}', [DemandeFactureController::class, 'GetInstanceById']);
        Route::post('/', [DemandeFactureController::class, 'CreateInstance']);
        Route::put('/{id}', [DemandeFactureController::class, 'UpdateInstance']);
        Route::delete('/{id}', [DemandeFactureController::class, 'DeleteInstance']);
    }
);

Route::group(
    [
        'prefix' => 'dem-forag',
        // 'middleware' => ['auth:sanctum', 'throttle:6,1', 'route_time_out'],
    ],
    function () {
        Route::get('/', [DemandeForagController::class, 'index']);
        Route::get('/{id}', [DemandeForagController::class, 'GetInstanceById']);
        Route::post('/', [DemandeForagController::class, 'CreateInstance']);
        Route::put('/{id}', [DemandeForagController::class, 'UpdateInstance']);
        Route::delete('/{id}', [DemandeForagController::class, 'DeleteInstance']);
    }
);

Route::group(
    [
        'prefix' => 'desc-soc',
        // 'middleware' => ['auth:sanctum', 'throttle:6,1', 'route_time_out'],
    ],
    function () {
        Route::get('/', [DescriptionSocController::class, 'index']);
        Route::get('/{id}', [DescriptionSocController::class, 'GetInstanceById']);
        Route::post('/', [DescriptionSocController::class, 'CreateInstance']);
        Route::put('/{id}', [DescriptionSocController::class, 'UpdateInstance']);
        Route::delete('/{id}', [DescriptionSocController::class, 'DeleteInstance']);
    }
);

Route::group(
    [
        'prefix' => 'devis-mat',
        // 'middleware' => ['auth:sanctum', 'throttle:6,1', 'route_time_out'],
    ],
    function () {
        Route::get('/', [DevisMatController::class, 'index']);
        Route::get('/{id}', [DevisMatController::class, 'GetInstanceById']);
        Route::post('/', [DevisMatController::class, 'CreateInstance']);
        Route::put('/{id}', [DevisMatController::class, 'UpdateInstance']);
        Route::delete('/{id}', [DevisMatController::class, 'DeleteInstance']);
    }
);

Route::group(
    [
        'prefix' => 'devis-obj',
        // 'middleware' => ['auth:sanctum', 'throttle:6,1', 'route_time_out'],
    ],
    function () {
        Route::get('/', [DevisObjController::class, 'index']);
        Route::get('/{id}', [DevisObjController::class, 'GetInstanceById']);
        Route::post('/', [DevisObjController::class, 'CreateInstance']);
        Route::put('/{id}', [DevisObjController::class, 'UpdateInstance']);
        Route::delete('/{id}', [DevisObjController::class, 'DeleteInstance']);
    }
);

Route::group(
    [
        'prefix' => 'matiere',
        // 'middleware' => ['auth:sanctum', 'throttle:6,1', 'route_time_out'],
    ],
    function () {
        Route::get('/', [MatsController::class, 'index']);
        Route::get('/all', [MatsController::class, 'index2']);
        Route::get('/{id}', [MatsController::class, 'GetInstanceById']);
        Route::post('/', [MatsController::class, 'CreateInstance']);
        Route::put('/{id}', [MatsController::class, 'UpdateInstance']);
        Route::delete('/{id}', [MatsController::class, 'DeleteInstance']);
    }
);

Route::group(
    [
        'prefix' => 'notification',
        // 'middleware' => ['auth:sanctum', 'throttle:6,1', 'route_time_out'],
    ],
    function () {
        Route::get('/', [NotifiactionController::class, 'index']);
        Route::get('/{id}', [NotifiactionController::class, 'GetInstanceById']);
        Route::post('/', [NotifiactionController::class, 'CreateInstance']);
        Route::put('/{id}', [NotifiactionController::class, 'UpdateInstance']);
        Route::delete('/{id}', [NotifiactionController::class, 'DeleteInstance']);
    }
);

Route::group(
    [
        'prefix' => 'objet',
        // 'middleware' => ['auth:sanctum', 'throttle:6,1', 'route_time_out'],
    ],
    function () {
        Route::get('/', [ObjController::class, 'index']);
        Route::get('/all', [ObjController::class, 'index2']);
        Route::get('/{id}', [ObjController::class, 'GetInstanceById']);
        Route::post('/', [ObjController::class, 'CreateInstance']);
        Route::put('/{id}', [ObjController::class, 'UpdateInstance']);
        Route::delete('/{id}', [ObjController::class, 'DeleteInstance']);
    }
);

Route::group(
    [
        'prefix' => 'var-chang',
        // 'middleware' => ['auth:sanctum', 'throttle:6,1', 'route_time_out'],
    ],
    function () {
        Route::get('/', [VaribleChangController::class, 'index']);
        Route::get('/{id}', [VaribleChangController::class, 'GetInstanceById']);
        Route::post('/', [VaribleChangController::class, 'CreateInstance']);
        Route::put('/{id}', [VaribleChangController::class, 'UpdateInstance']);
        Route::delete('/{id}', [VaribleChangController::class, 'DeleteInstance']);
    }
);

Route::group(
    [
        'prefix' => 'client',
        // 'middleware' => ['auth:sanctum', 'throttle:6,1', 'route_time_out'],
    ],
    function () {
        Route::get('/', [ClientController::class, 'index']);
        Route::get('/all', [ClientController::class, 'index2']);
        // Route::get('/{id}', [ClientController::class, 'GetInstanceById']);
        Route::get('/{id}', [ClientController::class, 'GetInstanceByCin']);
        Route::post('/', [ClientController::class, 'CreateInstance']);
        Route::put('/{id}', [ClientController::class, 'UpdateInstance']);
        Route::delete('/{id}', [ClientController::class, 'DeleteInstance']);
    }
);