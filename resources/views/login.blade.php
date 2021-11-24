@extends('layouts.auth-layout')
@section('title', 'صفحه ورود')
@section('card-header-title', 'صفحه ورود')
@section('content')
    @include('layouts.partials',['name'=>'email','type'=>'email','label'=>'ایمیل یا نام کاربری'])
    @include('layouts.partials',['name'=>'password','type'=>'password','label'=>'رمز عبور'])
    <div class="form-group  mt-3 ">
        <button class="btn btn-success">ورود</button>
    </div>

    <script>
        $(document).ready(function() {
            $('.btn').click(function() {
                $.ajax({
                    type: 'POST',
                    url: "{{ route('login') }}",
                    data: {
                        email: $('#email').val(),
                        password: $('#password').val()
                    },
                    success: function(data) {
                        if (data.access_token) {
                            localStorage.setItem("access_token", data.access_token);
                            console.log("login successful")
                        } else {
                            console.log(data.message);
                        }
                    }
                })
            })
        });
    </script>
@stop
