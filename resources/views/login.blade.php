@extends('layouts.auth-layout')
@section('title', 'صفحه ورود')
@section('card-header-title', 'صفحه ورود')
@section('content')
    <form action="">
        @csrf
        @include('layouts.partials',['name'=>'email','type'=>'email','label'=>'ایمیل یا نام کاربری'])
        @include('layouts.partials',['name'=>'password','type'=>'password','label'=>'رمز عبور'])
        <div class="form-group  mt-3 ">
            <input type="submit" value=" ورود" name="btn-register" class="btn btn-success">
        </div>
    </form>
@stop
