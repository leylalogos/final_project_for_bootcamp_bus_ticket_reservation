@extends('layouts.auth-layout')
@section('title', 'صفحه ثبت نام')
@section('card-header-title', 'صفحه ثبت نام')
@section('content')
    <form action="">
        @csrf
        @include('layouts.partials',['name'=>'name','type'=>'text','label'=>'نام'])
        @include('layouts.partials',['name'=>'email','type'=>'email','label'=>'ایمیل یا نام کاربری'])
        @include('layouts.partials',['name'=>'mobile','type'=>'mobile','label'=>'شماره موبایل'])
        @include('layouts.partials',['name'=>'password','type'=>'password','label'=>'رمز عبور'])
        @include('layouts.partials',['name'=>'password','type'=>'password','label'=>' تکرار روز عبور '])
        <div class="form-group  mt-3 ">
            <input type="submit" value=" ثبت نام" name="btn-register" class="btn btn-success">
        </div>

    </form>
@stop
