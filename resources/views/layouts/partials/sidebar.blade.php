<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">MAIN NAVIGATION</li>
            <li class="{{ request()->is('home') ? 'active' : '' }}">
                <a href="{{ url('/home') }}">
                    <i class="fa fa-dashboard"></i> <span>Home</span>
                </a>
            </li>
            @role('superadmin|admin')
            <li class="treeview {{ request()->is(['user', 'user/*', 'role', 'role/*', 'permission']) ? 'active' : '' }}">
                <a href="#">
                    <i class="fa fa-edit"></i> <span>Authentication</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ request()->is(['user', 'user/*']) ? 'active' : '' }}">
                        <a href="{{ route('user.index') }}">
                            <i class="fa fa-circle-o"></i> User
                        </a>
                    </li>
                    <li class="{{ request()->is(['role', 'role/*']) ? 'active' : '' }}">
                        <a href="{{ route('role.index') }}">
                            <i class="fa fa-circle-o"></i> Role
                        </a>
                    </li>
                    <li class="{{ request()->is('permission') ? 'active' : '' }}">
                        <a href="{{ route('permission.index') }}">
                            <i class="fa fa-circle-o"></i> <span>Permission</span>
                        </a>
                    </li>
                </ul>
            </li>
            @endrole
            <li class="header">OPERATIONS</li>
            <li class="{{ request()->is('logout') ? 'active' : '' }}">
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out"></i> <span>Logout</span>
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                    <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                </form>
            </li>
        </ul>
    </section>
</aside>
