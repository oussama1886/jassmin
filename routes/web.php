<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\ChartJSController;

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

Route::get('chart-js', [ChartJSController::class, 'index']);
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
// c la premiere page qui s'affiche page d'acceuil guest(folder).home(page.blade.php)
/*Route::get('/', function () {
    return view('guest.home');
});*/
// c la meme chose que le code precedent juste maintenant  avec une fonction home qui se trouve dans le controlleur quil va rejoindre la page d'acceuil
Route::get('/', 'App\Http\Controllers\GuestController@home');
Route::get('/product/details/{id}', 'App\Http\Controllers\GuestController@productDetails');
Route::get('/product/{categorie}/list', 'App\Http\Controllers\GuestController@shop');
Route::get('/product/{categorie}/list1', 'App\Http\Controllers\GuestController@shop1');
Route::get('/product/search', 'App\Http\Controllers\GuestController@search')->name('product.search');
Route::post('/product/search', 'App\Http\Controllers\GuestController@search');

Route::get('/guest/contact', 'App\Http\Controllers\GuestController@contact');
Route::get('/guest/apropos', 'App\Http\Controllers\GuestController@apropos');
Route::get('/guest/livraison', 'App\Http\Controllers\GuestController@livraison');

Route::get('/produit/sisco', 'App\Http\Controllers\GuestController@affichersize');
Route::post('/guest/aff', 'App\Http\Controllers\GuestController@affichersize')->name('guest.aff');




Auth::routes();
Route::get('/client/dashboard','App\Http\Controllers\ClientController@dashboard')->middleware('auth','is_active');
Route::get('/client/commandes','App\Http\Controllers\ClientController@mescommandes')->middleware('auth','is_active');
Route::get('/client/topbar', 'App\Http\Controllers\ClientController@moncommande')->middleware('auth', 'is_active');

//Route::post('/register', 'App\Http\Controllers\Auth\ClientController@register')->name('register');



Route::get('/client/profile','App\Http\Controllers\ClientController@profile');
Route::post('/client/Profile/update', 'App\Http\Controllers\clientController@updateProfile')->middleware('auth');
Route::post('/client/Profile/updat-password', 'App\Http\Controllers\clientController@updatePassword')->middleware('auth');

Route::get('/generate-pdf', [App\Http\Controllers\PdfController::class, 'generatePdf'])->name('generatePdf');

Route::get('/home', 'App\Http\Controllers\ProductController@index');

Route::post('/client/review/store', 'App\Http\Controllers\clientController@addReview')->middleware('auth','is_active');


Route::post('/client/order/store', 'App\Http\Controllers\CommandeController@store')/* ->middleware('auth','is_active') */;
Route::post('/client/order/store1', 'App\Http\Controllers\CommandeController@store1')/* ->middleware('auth','is_active') */;
Route::post('/remove-from-cart', 'App\Http\Controllers\CommandeController@remove');

Route::get('/client/cart', 'App\Http\Controllers\clientController@cart')/* ->middleware('auth') */;
Route::get('/guest/cart1', 'App\Http\Controllers\CommandeController@showCart1')->name('client.cart1');
Route::post('/checkout', [App\Http\Controllers\clientController::class, 'checkout'])->name('checkout');

Route::get('/client/lc/{idlc}/destroy', 'App\Http\Controllers\CommandeController@ligneCommandeDestroy')->middleware('auth');
Route::post('/client/checkout', 'App\Http\Controllers\clientController@checkout')->middleware('auth');

Route::post('/client/profile/update','App\Http\Controllers\RegisterController@update')->middleware('auth','is_active');

Route::get('/admin/commandes/details_commande/{id_cmd}', 'App\Http\Controllers\CommandeController@CommandeDetails')->middleware('auth','admin');
//Route::get('/admin/commandes/client_commande/{id_client}', 'App\Http\Controllers\CommandeController@client_Commande')->middleware('auth','admin');
Route::match(['get', 'post'], '/admin/commandes/client_commande/{id_client}', 'App\Http\Controllers\AdminController@searchCommandes1')->middleware(['auth', 'admin']);



Route::get('/admin/dashboard','App\Http\Controllers\AdminController@dashboard')->middleware('auth','admin');
Route::get('/admin/profile','App\Http\Controllers\AdminController@profile')->middleware('auth','admin');
Route::post('/admin/Profile/update', 'App\Http\Controllers\AdminController@updateProfile')->middleware('auth','admin');


///admin/categories ou je dois trouvé la page (chemin que je le mets comme je veux)
Route::get('/admin/categories','App\Http\Controllers\CategoryController@index')->middleware('auth','admin');

Route::post('/admin/categories/store','App\Http\Controllers\CategoryController@store')->middleware('auth','admin');



Route::get('/admin/categories/{id}/delete','App\Http\Controllers\CategoryController@destroy')->middleware('auth','admin');

Route::post('/admin/categories/update','App\Http\Controllers\CategoryController@update')->middleware('auth','admin');

//Route::post('/admin/categories/{category}/update', 'App\Http\Controllers\CategoryController@update')->name('categories.update');


// route product
// liste de produit /admin/products
Route::get('/admin/products','App\Http\Controllers\ProductController@index')->middleware('auth','admin');
Route::get('/admin/tabbord/vprod','App\Http\Controllers\AdminController@calculateSum')->middleware('auth','admin');
Route::get('/admin/tabbord/vmois','App\Http\Controllers\AdminController@calculateSum1')->middleware('auth','admin');
Route::get('/admin/tabbord/chiffre','App\Http\Controllers\AdminController@calculateSum2')->middleware('auth','admin');
Route::get('/admin/tabbord/commandes','App\Http\Controllers\AdminController@calculSum1')->middleware('auth','admin');
Route::post('/admin/product/store','App\Http\Controllers\ProductController@store')->middleware('auth','admin');
Route::get('/admin/dashboard', 'App\Http\Controllers\AdminController@calculSum')->middleware('auth', 'admin');
Route::get('/admin/tabbord/utilisateur','App\Http\Controllers\AdminController@utilisateur')->middleware('auth','admin');
Route::get('/admin/tabbord/tri_vente', 'App\Http\Controllers\AdminController@trivente')->middleware('auth', 'admin');
//Route::post('/admin/product/search','App\Http\Controllers\ProductController@searchProduct')->middleware(['auth', 'admin']);
Route::match(['get', 'post'], '/admin/product/search', 'App\Http\Controllers\ProductController@searchProduct')->middleware(['auth', 'admin']);

Route::get('/admin/product/size_color/{product_id}', 'App\Http\Controllers\ProductController@size_color')->name('sizeColor')->middleware('auth', 'admin');
Route::post('/admin/product/silor', 'App\Http\Controllers\ProductController@silor')->name('silor')->middleware('auth', 'admin');


Route::get('/admin/tabbord/catprod', 'App\Http\Controllers\AdminController@categProduit')->middleware('auth', 'admin');
Route::get('/admin/product/{id}/delete','App\Http\Controllers\ProductController@destroy')->middleware('auth','admin');
Route::get('/admin/product/{id}/destroysize','App\Http\Controllers\ProductController@destroysize')->middleware('auth','admin');
Route::put('/admin/product/updateSizeColor/{id}', 'App\Http\Controllers\ProductController@updateSizeColor')->name('admin.product.updateSizeColor');


Route::post('/admin/product/update','App\Http\Controllers\ProductController@update')->middleware('auth','admin');



// affichage des clients et bloquage et debloquage
Route::get('/admin/clients','App\Http\Controllers\AdminController@clients')->middleware('auth','admin');
Route::get('/admin/user/{id}/bloquer','App\Http\Controllers\AdminController@BloquerUser')->middleware('auth','admin');
Route::get('/admin/user/{id}/debloquer','App\Http\Controllers\AdminController@DeBloquerUser')->middleware('auth','admin');
Route::get('/admin/commandes','App\Http\Controllers\AdminController@commandes')->middleware('auth','admin');

/* Route::get('/admin/dashboard','App\Http\Controllers\AdminController@calculateSum')->middleware('auth','admin');
 */
//auth : verification si il est connecté ou nn et admin verification si l'utlisateur admin ou nn
Route::match(['get', 'post'], '/admin/clients/search', 'App\Http\Controllers\AdminController@searchClients')->middleware(['auth', 'admin']);
Route::match(['get', 'post'], '/admin/commandes/search', 'App\Http\Controllers\AdminController@searchCommandes')->middleware(['auth', 'admin']);
Route::get('/client/bloquerMessage','App\Http\Controllers\ClientController@afficherMessageBloquee')->middleware('auth');
