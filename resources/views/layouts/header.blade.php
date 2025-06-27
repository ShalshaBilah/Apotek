<header class="main-header" style="background-color: #01796f;">
    <!-- Logo -->
    <a href="index2.html" class="logo" style="background-color: #015f57;">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">TL</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg">{{ config('app.name') }}</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" style="background-color: #01796f;">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button"
            style="background-color: #01796f; border-color: #015f57; color: white; padding: 10px; border-radius: 5px;">
            <span class="sr-only">Toggle navigation</span>
        </a>


        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Messages: style can be found in dropdown.less-->
                <li class="dropdown messages-menu"></li>

                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="color: white;">
                        <img src="{{ asset('AdminLTE-2/dist/img/user2-160x160.jpg')}}" class="user-image"
                            alt="User Image">
                        <span class="hidden-xs">{{ Auth::user()->name }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header" style="background-color: #015f57; color: white;">
                            <img src="{{ asset('AdminLTE-2/dist/img/user2-160x160.jpg')}}" class="img-circle"
                                alt="User Image">
                            <p>
                                {{ Auth::user()->name }}
                            </p>
                            <p>
                                {{ Auth::user()->email }}
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item dropdown-footer bg-transparent border-0">
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </li>
                    </ul>
                </li>

            </ul>
        </div>
    </nav>
</header>