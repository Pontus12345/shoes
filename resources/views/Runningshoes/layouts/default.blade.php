<!doctype html>
<html>
<head>
    @include('Runningshoes/includes.head')
</head>
<body>
    <div class="wrapper">

        <header class="row">
            <div id="inner-header">
                @include('Runningshoes/includes.header')
            </div>
        </header>

        <content id="main" class="row">
            <div id="inner-main" class="container">
                @include('Runningshoes/includes.aside')
                @yield('Runningshoes/content')
            </div>
        </content>

        <footer class="row">
            <div id="inner-footer" class="container">
                @include('Runningshoes/includes.footer')
            </div>
        </footer>
    </div>
</body>
</html>