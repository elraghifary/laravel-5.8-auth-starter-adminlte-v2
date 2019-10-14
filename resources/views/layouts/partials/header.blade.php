<header class="main-header">
    <a href="{{ route('home') }}" class="logo">
        <span class="logo-mini">{{ env('APP_SHORT_NAME') }}</span>
        <span class="logo-lg">{{ env('APP_NAME') }}</span>
    </a>
    <nav class="navbar navbar-static-top" role="navigation">
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                      <span style="font-weight: bold">{{ Auth::user()->name }}</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</header>
