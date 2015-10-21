<!-- Main Header -->
<header class="main-header">

    <!-- Logo -->
    <a href="{{route('home')}}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>S</b>MG</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Admin</b>SMG</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button" onclick="switchCollapsed();">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- User Account Menu -->
                <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <!-- The user image in the navbar-->
                        <img src="/bower_components/adminLTE/dist/img/user2-160x160.jpg" class="user-image" alt="User Image" />
                        <!-- hidden-xs hides the username on small devices so only the image appears. -->
                        <span class="hidden-xs">{{Flysap\Application\current_username()}}</span>
                    </a>

                    <?php $user = Flysap\Application\current_user(); ?>

                    <ul class="dropdown-menu">
                        <!-- The user image in the menu -->
                        <li class="user-header">
                            <img src="/bower_components/adminLTE/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image" />
                            <p>
                                {{$user->name}} - {{ucfirst($user->role)}}
                                <small>Some text</small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">{{trans('Profile')}}</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{route('logout')}}" class="btn btn-default btn-flat">{{trans('Sign out')}}</a>
                            </div>
                        </li>
                    </ul>
                </li>

                <li class="messages-menu">
                    <a href="{{route('admin.mail.index')}}">
                        <i class="fa fa-envelope-o"></i>
                    </a>
                </li>

                <!-- Control Sidebar Toggle Button -->
                <li>
                    <a href="{{route('settings')}}"><i class="fa fa-gears"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</header>