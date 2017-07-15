<div class="container">
    <nav class="nav">
        <div class="nav-left">
            <a class="nav-item is-brand" href="{{ url('/') }}">
                {{ config('app.name', 'Laravel') }}
            </a>
        </div>

        <div class="nav-center">
            <a class="nav-item" href="https://github.com/richpeers/surveys" target="_blank">
                <span class="icon"><i class="fa fa-github"></i></span>
            </a>
            <a class="nav-item" href="https://twitter.com/richpeers" target="_blank">
                <span class="icon"> <i class="fa fa-twitter"></i></span>
            </a>
        </div>

        <span id="nav-toggle" class="nav-toggle"
              @click="navIsActive = !navIsActive"
              :class="{'is-active' :  navIsActive}">
            <span></span><span></span><span></span>
        </span>

        <div id="nav-menu" class="nav-right nav-menu" :class="{'is-active' : navIsActive}">

            <div class="nav-item">
                <div class="field is-grouped">
                    @if (Auth::guest())
                        <p class="control">
                            <a class="button" href="{{ route('login') }}">Login</a>
                        </p>
                        <p class="control">
                            <a class="button" href="{{ route('register') }}">Register</a>
                        </p>
                    @else
                        <p class="control">
                            <a class="button" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();"
                            >Logout</a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                        </p>
                    @endif
                </div>
            </div>
        </div>
    </nav>
</div>
