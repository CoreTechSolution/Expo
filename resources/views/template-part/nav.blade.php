<nav class="navbar navbar-expand-sm navbar-dark">
                    <!-- Brand -->
                    <a class="navbar-brand" href="#"><img src="assets/images/logo.png"></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <!-- Links -->
                    <div class="collapse navbar-collapse" id="collapsibleNavbar">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="#">Top Events</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Add Events</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Speakers</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#">Your Calendar</a>
                            </li>
                            @guest
                            <li class="nav-item">
                                <a class="nav-link join-login" href="{{ route('login') }}">Login</a>
                            </li>
                            @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('my-account') }}">My Account</a>
                                    <a class="dropdown-item" href="{{ route('logout') }}" 
                                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @endguest
                    </ul>
                </div>
            </nav>