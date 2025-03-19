<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ItineraireController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::get('/itineraires', [ItineraireController::class, 'index']);

// Route::post('/itineraires', function(){

// });



// Route::get('/products', [ProductController::class, 'index']); 
// Route::post('/products', [ProductController::class, 'store']);


Route::resource('itineraires', ItineraireController::class);

// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::get('/itineraires', [ItineraireController::class, 'index']);
Route::get('/itineraires/{id}', [ItineraireController::class, 'show']);
Route::get('/itineraires/search/{categorie}', [ItineraireController::class, 'search']);

// Protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/itineraires', [ItineraireController::class, 'store']);
    Route::put('/itineraires/{id}', [ItineraireController::class, 'update']);
    Route::delete('/itineraires/{id}', [ItineraireController::class, 'destroy']);
});




Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); 







// Route::get('/products',function(){
//     return 'products';
// });

// Route::post('/products',function(){
//      return Product::create([
//         'name' => 'Product One',
//         'slug' => 'product-one',
//         'description' => 'this the product one',
//         'price' => '99.99',
//      ]);
// });


// Route::get('/itineraires',function(){
//     return Itineraire::all();
// });

// Route::post('/itineraires', function(){
//     return Itineraire::create([
//         'title' => 'Itineraires One',
//         'categorie' => 'itineraires-one',
//         'duree' => '2 days',
//         'image' => 'itineraires img',
//     ]);
// });