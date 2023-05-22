<!DOCTYPE html>
@extends('layouts.login-pages')
  
@section('content')
    <div class="login_panel">
        <div class='login_title'><h2>Forgot Password</h2></div>
        <div class='detail-alert'>Please provide your email and if it exists we will send you a password reset</div>
        <form method='post'>
            <input type="hidden" name="_token" value="{{ csrf_token() }}" />
            <div class='login_details'>
                <input class='login_input' name="email_address" placeholder="Email Address">
                <div class='login_buttons'>
                    <a class='abtn' href='/login'>Back</a>
                    <input class='abtn' type='submit' value='Send reset'>
                </div>
            </div>
        </form>
    </div>
@endsection
