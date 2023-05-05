@include('admin.layout.header')

<body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                @include('admin.layout.sidebar')
            </div>
        </div>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            @yield('main')

            <footer>
                <div class="footer clearfix mb-0 text-muted text-center">
                    <p>Crafted with <span class="text-danger"></span> by <a
                            href="https://polibangcreativestudio.my.id">Polibang Creative Studio</a></p>
                </div>
            </footer>
        </div>
    </div>
    @include('admin.layout.footer')
</body>

</html>
