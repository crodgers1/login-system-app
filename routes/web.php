<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
 
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

// Old default
//Route::get('/', function () {
//    return view('login');
//});

// used to test function and operations
Route::get('/test', function (Request $request) {
    
    $logged_in_required = preg_match('/^test/i',$request->path());
    echo $logged_in_required;
    die();
    
});


Route::get('/', function () {
    return redirect('/login');
});

Route::get('/admin/dashboard', function () {
    return view('admin/dashboard');
});

Route::get('/forgot-password', function () {
    return view('front/forgot_password');
});

Route::post('/forgot-password', function () {

    $results = DB::select('select * from users where email_address = ?', array(Input::get('email_address')));
    if($results && count($results) > 0) {
    
        $recip = $results->email_address;
        $message = 'A password reset has been requested. Click <a href="127.0.0.1:8080/reset-password">here</a> to change your password';
    //    mail($recip,'Password Reset',$message);

    }
    Session::put('message', array('message','If this user exists an email will have been sent to reset the password. Please check your email'));
    return redirect('/login');
});


Route::get('/login', function () {
    $message=Session::get('message');
    Session::forget('message');
    if($message) {
        return view('front/login',array('message'=>$message));
    } else {
        return view('front/login');
    }
});

Route::post('/login', function () {
    $results = DB::select('select * from users where email_address = ?', array(Input::get('email_address')));
    if($results && count($results) > 0) {
        // check hash 
        if (Hash::check(Input::get('password'), $results[0]->password)) {
        // Match
            Session::put('user',$results[0]->id);
            Session::put('pass',Input::get('password'));
            return redirect('/admin/dashboard');
        }    
    }
    // login failed
    Session::put('message', array('error','The log in details provided were incorrect. Please try again'));
    return redirect('/login');
});

Route::get('/logout', function () {
    // logout process
    Session::forget('user');
    Session::forget('pass');
    return redirect('/login');
});

Route::get('/register', function (Request $request) {
    $message=Session::get('message');
    Session::forget('message');
    if($message) {
        return view('front/register',array('message'=>$message));
    } else {
        return view('front/register');
    }
});

Route::post('/register', function () {
    // register process
    $results = DB::select('select * from users where email_address = ?', array(Input::get('email_address')));
    // check it is unique
    if($results && count($results) > 0) {
        // not unique
        Session::put('message', array('error','User already exists for user. Please log in'));
        return redirect('/register');
    } elseif(Input::get('password') != Input::get('confirm_password')) {
        // passwords dont match
        Session::put('message', array('error','The passwords provided do not match'));
        return redirect('/register');
    } else {
        // create and store
        DB::insert('insert into users (email_address,password) values (?, ?)', array(Input::get('email_address'), Hash::make(Input::get('password'))));
        Session::put('message', array('message','User created. Please log in'));
        return redirect('/login');
    }
    return redirect('front/login');
});

Route::get('/reset-password', function () {
    return view('front/reset_password');
});

