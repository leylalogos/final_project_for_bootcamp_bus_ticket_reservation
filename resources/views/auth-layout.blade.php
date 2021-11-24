<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <title>@yield('title')</title>
</head>

<body>
    <div class="container">
        <div class="row  justify-content-center mt-5">
            <div class="col-6">
                <div class="card card-header">
                    @yield('card-header-title')
                </div>
                <div class="card card-body">
                    @yield('content')
                </div>
                
            </div>
        </div>
    </div>
</body>

</html>
