<nav class="navbar navbar-default navbar-static-top">
    <div class="container">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse"
                aria-expanded="false">
                <span class="sr-only">@lang('Toggle Navigation')</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/home') }}" style="color: #000;">
                {{ (Auth::check() && (Auth::user()->role == 'student' || Auth::user()->role == 'teacher' ||
                Auth::user()->role == 'admin' || Auth::user()->role == 'accountant' || Auth::user()->role ==
                'librarian'))?Auth::user()->school->name:config('app.name') }}
            </a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->

            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                @guest
                <li><a href="{{ route('login') }}" style="color: #000;">@lang('Login')</a></li>
                @else
                @if(\Auth::user()->role == 'student')
                <li class="nav-item">
                    <a href="{{url('user/'.\Auth::user()->id.'/notifications')}}" class="nav-link nav-link-align-btn"
                        role="button">
                        <i class="material-icons text-muted">email</i>
                        <?php
                            $mc = \App\Notification::where('student_id',\Auth::user()->id)->where('active',1)->count();
                        ?>
                        @if($mc > 0)
                        <span class="label label-danger" style="vertical-align: middle;border-style: none;border-radius: 50%;width: 30px;height: 30px;">{{$mc}}</span>
                        @endif
                    </a>
                </li>
                @endif
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle nav-link-align-btn" data-toggle="dropdown" role="button"
                        aria-expanded="false" aria-haspopup="true">
                        <span class="label label-danger">
                            {{ ucfirst(\Auth::user()->role) }}
                        </span>&nbsp;&nbsp;
                        @if(!empty(Auth::user()->pic_path))
                        <img src="{{asset('01-progress.gif')}}" data-src="{{url(Auth::user()->pic_path)}}" alt="Profile Picture"
                            style="vertical-align: middle;border-style: none;border-radius: 50%;width: 30px;height: 30px;">
                        @else
                        @if(strtolower(Auth::user()->gender) == 'male')
                        <img src="{{asset('01-progress.gif')}}" data-src="https://img.icons8.com/color/48/000000/architect.png"
                            alt="Profile Picture" style="vertical-align: middle;border-style: none;border-radius: 50%;width: 30px;height: 30px;">
                        @else
                        <img src="{{asset('01-progress.gif')}}" data-src="https://img.icons8.com/color/48/000000/architect-female.png"
                            alt="Profile Picture" style="vertical-align: middle;border-style: none;border-radius: 50%;width: 30px;height: 30px;">
                        @endif
                        @endif
                        &nbsp;&nbsp;{{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu">
                        @if(Auth::user()->role != 'master')
                        <li>
                            <a href="{{url('user/'.Auth::user()->student_code)}}">@lang('Profile')</a>
                        </li>
                        @endif
                        <li>
                            <a href="{{url('user/config/change_password')}}">@lang('Change Password')</a>
                        </li>
                        @if(env('APP_ENV') != 'production')
                        <li>
                            <a href="{{url('user/config/impersonate')}}">
                                {{ app('impersonate')->isImpersonating() ? __('Leave Impersonation') : __('Impersonate') }}
                            </a>                                
                        </li>
                        @endif
                        <li>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                @lang('Logout')
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>