<nav class="navbar navbar-default" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ url('/') }}">Social</a>
        </div>
        <div class="collapse navbar-collapse">
         @if (Auth::check())
            <ul class="nav navbar-nav">
                <li><a href="#">Timeline</a></li>
                <li><a href=" {{ url('friends') }} ">Friends</a></li>
            </ul>
            <form class="navbar-form navbar-left" role="search" action="{{ url('/search') }}">
                <div class="form-group">
                    <input type="text" name="query" class="form-control" placeholder="Find people">
                </div>
                <button type="submit" class="btn btn-default">Search</button>
            </form>
         @endif
            <ul class="nav navbar-nav navbar-right">
             @if (Auth::check())
                <li><a href="{{ url('user/'.Auth::user()->username) }}">{{ Auth::user()->getNameOrUsername() }}</a></li>
                <li><a href="{{ url('/profile/edit') }}">Update profile</a></li>
                <li><a href="{{ url('/signout') }}">Sign out</a></li>
             @else
                <li><a href="{{ url('signup') }}">Sign up</a></li>
                <li><a href="{{ url('signin') }}">Sign in</a></li>
             @endif
            </ul>
        </div>
    </div>
</nav>