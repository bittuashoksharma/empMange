<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Employee Mangement System') }}</title>

    <!--begin::Fonts-->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
        <!--end::Fonts-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" />
        <!--begin::Global Stylesheets Bundle(used by all pages)-->
        <link href="{{ url('/') }}/css/plugins.bundle.css" rel="stylesheet" type="text/css" />
        <link href="{{ url('/') }}/css/style.bundle.css" rel="stylesheet" type="text/css" />
        <!--end::Global Stylesheets Bundle--> 

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body id="kt_body" class="bg-body" style="background-color: #f5f8fa !important;">
    <div id="app"  class="d-flex flex-column flex-root">
        <main class="d-flex flex-column flex-root">
            @yield('content')
        </main>
    </div>
    <script src="{{ url('/') }}/js/plugins.bundle.js"></script>
    <script src="{{ url('/') }}/js/scripts.bundle.js"></script>
</body>
</html>
