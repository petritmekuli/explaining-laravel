<?php

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use Illuminate\Contracts\Cache\LockTimeoutException;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('example/first', function(){
    // This creates a lock object but it won't persist it into the db table.
    $lock = Cache::lock('first_lock', 10);

    /**
     * get() actually inserts/updates the lock obj created earlier to db table.
     * And that depends if the lock key has been used before. If it is the first
     * time the it will be created.
     * Since the lock obj in the db table known as a row, never leaves the table,
     * only the expiration time(time converted to sec) is less than now. Tells
     * state of the lock. In this case update will increase expiration to something
     * similar to now()+10sec in this case.
     */
    if($lock->get()){
        /**
         * We are trying to secure this "first" key to be used only once at a time.
         * Actually to avoid something similar to what we avoid when we use transactions.
         */
        Cache::put('first', 'The value', 20);
        /**
         * Let's not release the lock. But still it will release itself after 10sec
         * that it was created. This action will be performed only once within 10sec.
         * After the time ends the lock will still be present within the cache_locks
         * table. But if we use the same key it will be updated, and increasing the
         * expiration time which means the lock is being hold, and not available for
         * other resources to use.
         */
        dump('We were able to use the lock.');
    }else{
        dump('We were NOT able to use the lock. It was being hold from some other resource.');
    }
});

Route::get('example/second', function(){
    // We are using the same lock key as in the first example.
    $lock = Cache::lock('first_lock', 10);

    if($lock->get()){
        /**
         * This will hold the lock until we are done with the resource. Differently
         * the release() will delete the row from the table. Actually you can see the
         * key is being stored in the db table only through the debugbar.
         */
        $lock->release();
        dump('We were able to use the lock.');
    }else{
        dump('We were NOT able to use the lock. It was being hold from some other resource.');
    }
});

Route::get('example/third', function(){
    $lock = Cache::lock('first_lock', 10);

    try{
        // This waits for lock to be released, if it takes longer it will throw exception.
        $lock->block(8); //$lock being held for 10sec. So this will throw exception.
        // $lock->block(10); //This waits long enough and it will get the lock.
        Cache::put('first', 'Value');
        dump('We were able to use the lock.');
    }catch(LockTimeoutException $exception){
        return response('Waited for to long. Try again latter.', 400);
    }finally{
        // $lock->release();// Typically you would release the lock here.
        // Not releasing just to show that exception handling functionality.
    }
});
