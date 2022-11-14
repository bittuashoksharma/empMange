<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ECRM</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" >
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.0.3/css/font-awesome.css">
    
    <script src="{{ url('/') }}/ckeditor/ckeditor.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  </head>
  <body class="hold-transition sidebar-mini">
    <div class="wrapper" id="app">
       <router-view></router-view>
    </div>
  
  </body>
</html>