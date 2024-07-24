<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
            <a href="{{ url('user/profile') }}" class="d-block">{{ $name }}</a>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="{{ url('/dashboard') }}" class="nav-link">
                    <i class="nav-icon fas fa-th"></i>
                    <p>
                        {{ __('Dashboard') }}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ url('/reward') }}" class="nav-link">
                    <i class="nav-icon fas fa-money-bill"></i>
                    <p>
                        {{ __('User Reward List admin ') }}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ url('/form') }}" class="nav-link">
                    <i class="nav-icon fas fa-money-bill"></i>
                    <p>
                        {{ __('Form') }}
                    </p>
                </a>
            </li>

            {{-- <li class="nav-item">
                <a href="{{ url('') }}" class="nav-link">
                    <i class="nav-icon fas fa-money-bill"></i>
                    <p>
                        {{ __('User') }}
                    </p>
                </a>
            </li> --}}


            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon far fa-address-card"></i>
                    <p>
                        {{ __('About us') }}
                    </p>
                </a>
            </li>



        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
