<div class="container">
    <nav class="navbar">

        <div class="navbar-brand">
            <a class="navbar-item" href="{{ url('/') }}">Surveys</a>

            <a class="navbar-item" href="https://github.com/richpeers/surveys" target="_blank">
                <span class="icon" style="color: #333;"><i class="fa fa-github"></i></span>
            </a>
            <a class="navbar-item" href="https://twitter.com/richpeers" target="_blank">
                <span class="icon" style="color: #55acee;"><i class="fa fa-twitter"></i></span>
            </a>

            <div class="navbar-burger" :class="{ 'is-active': navIsActive }" @click="navIsActive = !navIsActive"
                 data-target="navMenu">
                <span></span>
                <span></span>
                <span></span>
            </div>

        </div>

        <div id="navMenu" class="navbar-menu" :class="{ 'is-active': navIsActive }">

            <div class="navbar-end">

                <a class="navbar-item" href="{{url('/')}}">New Survey</a>

                @if (Auth::guest())
                    <div class="nav-item">
                        <div class="field is-grouped">
                            <p class="control">
                                <a class="button is-primary is-inverted" href="{{ route('login') }}">Login</a>
                            </p>
                            <p class="control">
                                <a class="button is-primary" href="{{ route('register') }}">Register</a>
                            </p>
                        </div>
                    </div>
                @else
                    <div class="navbar-item has-dropdown is-hoverable">
                        <a class="navbar-link is-active" href="#">
                            {{ Auth::user()->name }}
                        </a>

                        <div class="navbar-dropdown">
                            <a class="navbar-item" href="#">Account</a>

                            <a class="navbar-item" href="{{ url('/surveys') }}">My Surveys</a>

                            <hr class="navbar-divider">

                            <a class="navbar-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            >Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </div>

                    </div>
                @endif
            </div>

        </div>
    </nav>
</div>
