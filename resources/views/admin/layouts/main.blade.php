<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Media</title>
    {{-- Bootstrap css --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

    {{-- Fontawesome css --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet"
          integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback"
          rel="stylesheet">
    <link type="text/css" href="{{ asset('admin_dashboard/plugins/fontawesome-free/css/all.min.css') }}"
          rel="stylesheet">
    <link type="text/css" href="{{ asset('admin_dashboard/dist/css/adminlte.min.css') }}" rel="stylesheet">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" id="hamburger-btn" data-widget="pushmenu" href="#" role="button"><i
                           class="fas fa-bars"></i></a>
                </li>
            </ul>
        </nav>
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a class="brand-link" href="#">

                <span class="brand-text font-weight-light">Admin Dashboard </span>
            </a>
            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" data-accordion="false"
                        role="menu">

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('profile') }}">
                                <i class="fas fa-user-circle"></i>
                                <p>
                                    Profile
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin#list') }}">
                                <i class="fas fa-users"></i>
                                <p>
                                    Admin List
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('category') }}">
                                <i class="fa-solid fa-list"></i>
                                <p>
                                    Category
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('post') }}">
                                <i class="fa-solid fa-pen"></i>
                                <p>
                                    Post
                                </p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('trendPost') }}">
                                <i class="fas fa-book"></i>
                                <p>
                                    Trend Post
                                </p>
                            </a>
                        </li>

                        <li class="nav-item mt-2">
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button class="btn btn-outline-danger text-light" type="submit"><i
                                       class="fas fa-sign-out-alt me-2"></i><span
                                          id="logout-text">Logout</span></button>
                            </form>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <div class="content-wrapper">
            <section class="content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </section>
        </div>

    </div>

    <aside class="control-sidebar control-sidebar-dark">
    </aside>
    </div>
    {{-- Bootstrap js --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>
    <script src="{{ asset('admin_dashboard/plugins/jquery/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_dashboard/plugins/bootstrap/js/bootstrap.bundle.min.js') }}" type="text/javascript">
    </script>
    <script src="{{ asset('admin_dashboard/dist/js/adminlte.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('admin_dashboard/dist/js/demo.js') }}" type="text/javascript"></script>
    <script src="{{ asset('js/app.js') }}" type="text/javascript"></script>

    @yield('javascript')
</body>

</html>
