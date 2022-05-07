<nav class="navbar navbar-vertical fixed-left navbar-expand-md navbar-light bg-white" id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main"
            aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand pt-0" href="{{ route('home') }}">
            <img src="{{ asset('argon') }}/img/brand/blue.png" class="navbar-brand-img" alt="...">
        </a>
        <!-- User -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                            <img alt="Image placeholder" src="{{ asset('argon') }}/img/theme/team-1-800x800.jpg">
                        </span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">{{ __('Welcome!') }}</h6>
                    </div>
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>{{ __('My profile') }}</span>
                    </a>

                    <div class="dropdown-divider"></div>
                    <a href="{{ route('logout') }}" class="dropdown-item" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                        <i class="ni ni-user-run"></i>
                        <span>{{ __('Logout') }}</span>
                    </a>
                </div>
            </li>
        </ul>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col- collapse-brand">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('argon') }}/img/brand/blue.png">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse"
                            data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false"
                            aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Form -->
            {{-- <form class="mt-4 mb-3 d-md-none">
                <div class="input-group input-group-rounded input-group-merge">
                    <input type="search" class="form-control form-control-rounded form-control-prepended"
                        placeholder="{{ __('Search') }}" aria-label="Search">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <span class="fa fa-search"></span>
                </div>
            </div>
        </div>
        </form> --}}
        <!-- Navigation -->
        <ul class="navbar-nav">
            <h6 class="navbar-heading text-muted ">Navigation</h6>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="fa fa-home text-info"></i> {{ __('Dashboard') }}
                </a>
            </li>


            <li class="nav-item">
                <a class="nav-link" href="{{route('hotdeals.index')}}">
                    <i class="fab fa-adversal text-info"></i> {{ __('Advertisement') }}
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{route('announcement.index')}}">
                    <i class="fas fa-bullhorn text-info"></i> {{ __('Announcement') }}
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{route('information.index')}}">
                    <i class="fas fa-bullhorn text-info"></i> {{ __('Information') }}
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{route('application.index')}}">
                    <i class="fab fa-asymmetrik text-info"></i> {{ __('Applications') }}
                </a>
            </li>

               <li class="nav-item">
                <a class="nav-link" href="{{route('member.index')}}">
                    <i class="fas fa-user-friends text-info"></i> {{ __('Members') }}
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{route('business.index')}}">
                    <i class="fas fa-business-time text-info"></i> {{ __('Business Profiles') }}
                </a>
            </li>

            <li class="nav-item">
                {{-- appuser.index --}}
                <a class="nav-link" href="{{route('businesssector.index')}}">
                    <i class="far fa-list-alt  text-info"></i> {{ __('Business Sectors') }}
                </a>
            </li>

             <li class="nav-item">
                <!--<a class="nav-link" href="">-->
                <a class="nav-link" href="{{route('jobpost.index')}}">
                    <i class="fas fa-business-time text-info"></i> {{ __('Job Posts') }}
                </a>
            </li>


            <li class="nav-item">
                {{-- appuser.index --}}
                <a class="nav-link" href="{{route('jobtitle.index')}}">
                    <i class="far fa-list-alt  text-info"></i> {{ __('Job Title') }}
                </a>
            </li>
            <li class="nav-item">
                {{-- appuser.index --}}
                <a class="nav-link" href="{{route('requests.index')}}">
                    <i class="fas fa-hand-holding-usd text-info"></i> {{ __('Requests') }}
                </a>
            </li>
            <li class="nav-item">
                {{-- appuser.index --}}
                <a class="nav-link" href="{{route('recipes.index')}}">
                    <i class="fas fa-utensils text-info"></i> {{ __('Recipes') }}
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{route('roles.index')}}">
                    <i class="far fa-id-badge text-info"></i> {{ __('Role') }}
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{route('committee.index')}}">
                    <i class="far fa-user text-info"></i> {{ __('Committee') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('users.index')}}">
                    <i class="far fa-user text-info"></i> {{ __('User') }}
                </a>
            </li>


            <li class="nav-item">
                <a class="nav-link" href="{{route('town.index')}}">
                    <i class="fas fa-city text-info"></i> {{ __('Towns') }}
                </a>
            </li>

             <li class="nav-item">
                <a class="nav-link" href="{{ route('native.index') }}">
                    <i class="fab fa-fort-awesome text-info"></i> {{ __('Native') }}
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{route('centre.index')}}">
                    <i class="fas fa-store-alt text-info"></i>{{ __('Centers') }}
                </a>
            </li>







            <!--<li class="nav-item">
                <a class="nav-link" href="{{route('counties.index')}}">
                    <i class="far fa-folder text-info"></i> Country
                </a>
            </li>-->














            @canany(['booking_access','branch_booking_access'])
            <li class="nav-item">
                <a class="nav-link" href="{{ route('booking.index') }}">
                    <i class="fas fa-cut text-danger"></i> {{ __('Booking') }}
                </a>
            </li>
            @endcan

            @can('report_access')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('report.index') }}">
                    <i class="far fa-file-word text-danger"></i> {{ __('Report') }}
                </a>
            </li>
            @endcan
            @can('custom_notification_access')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('custom.index') }}">
                    <i class="fab fa-viber text-danger"></i> {{ __('Custom Notification') }}
                </a>
            </li>
            @endcan
            @can('setting_access')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('setting.index') }}">
                    <i class="far fa-clock text-danger"></i> {{ __('Setting') }}
                </a>
            </li>
            @endcan
            @can('privacy_access')
            <li class="nav-item">
                <a class="nav-link" href="{{ route('pp') }}">
                    <i class="far fa-handshake text-danger"></i> {{ __('Privacy and Policy') }}
                </a>
            </li>
            @endcan
            @canany(['review_access','branch_review_access'])
            <li class="nav-item">
                <a class="nav-link" href="{{ route('review.index') }}">
                    <i class="far fa-smile-beam text-danger"></i> {{ __('Review') }}
                </a>
            </li>
            @endcan
            <li class="nav-item">
                <a class="nav-link" href="{{ route('logout') }}">
                    <i class="ni ni-user-run text-info"></i> {{ __('Sign out') }}
                </a>
            </li>

        </ul>
        <!-- Divider -->
        <hr class="my-3">
        <!-- Heading -->
        {{-- <h6 class="navbar-heading text-muted">Documentation</h6> --}}
        <!-- Navigation -->
        {{-- <ul class="navbar-nav mb-md-3">
                <li class="nav-item">
                    <a class="nav-link"
                        href="https://demos.creative-tim.com/argon-dashboard/docs/getting-started/overview.html">
                        <i class="ni ni-spaceship"></i> Getting started
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"
                        href="https://demos.creative-tim.com/argon-dashboard/docs/foundation/colors.html">
                        <i class="ni ni-palette"></i> Foundation
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link"
                        href="https://demos.creative-tim.com/argon-dashboard/docs/components/alerts.html">
                        <i class="ni ni-ui-04"></i> Components
                    </a>
                </li>
            </ul> --}}
    </div>
    </div>
</nav>
