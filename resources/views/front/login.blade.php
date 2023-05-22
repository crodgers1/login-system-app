<!DOCTYPE html>
@extends('layouts.login-pages')
  
@section('content')
    <div class="login_panel">
        <div class='login_title'><h2>Login</h2></div>
        <form name='login_form' method='POST'>
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <div class='login_details'>
                <input class='login_input' name="email_address" placeholder="Username"><br>
                <input class='login_input' type='password' name="password" placeholder="Password">
                <div class='login_buttons'>
                    <a class='abtn' href='/register'>Register</a>
                    <input class='abtn' type='submit' value='Confirm'>
                </div>
                <div>
                    <a class='forgot_link' href='/forgot-password'> forgot my password</a>
                </div>
            </div>
        </form>
    </div>
@endsection
