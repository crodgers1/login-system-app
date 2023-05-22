<!DOCTYPE html>
@extends('layouts.login-pages')
  
@section('content')

    <div class="login_panel">
        <div class='login_title'><h2>Register</h2></div>
        <form name='login_form' method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <div class='login_details'>
                <input class='login_input' name="email_address" placeholder="Username"><br>
                <input class='login_input' type='password' name="password" placeholder="Password">
                <input class='login_input' type='password' name="confirm_password" placeholder="Confirm Password">
                <div class='login_buttons'>
                    <a class='abtn' href='/login'>Back</a>
                    <input class='abtn' type='submit' value='Register'>
                </div>
            </div>
        </form>
    </div>
@endsection
