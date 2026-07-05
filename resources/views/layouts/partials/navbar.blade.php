<ul class="navbar-nav mr-auto">
    @if (request()->is('admin*') && auth()->guard('admin')->check())
        @include('layouts.partials.navbar.admin')
    @else
        @include('layouts.partials.navbar.app')
    @endif
</ul>
