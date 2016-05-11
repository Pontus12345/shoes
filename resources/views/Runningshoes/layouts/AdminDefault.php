<!doctype html>
<html>
<head>
    @include('Runningshoes/includes/Admin.head')
</head>
<body>

<div class="wrapper">

    <header class="row">
        <div id="inner-header">
            @include('Runningshoes/Admin/includes/Admin.header')
        </div>
    </header>

    <content id="main" class="row">
        <div id="inner-main" class="container">
            @yield('Runningshoes/content')
        </div>
    </content>

    <footer class="row">
        <div id="inner-footer" class="container">
            @include('Runningshoes/includes/Admin.footer')
        </div>
    </footer>
<!-- 
-->
</div>
</body>
</html>