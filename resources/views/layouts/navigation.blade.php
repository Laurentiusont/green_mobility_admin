<!-- Sidebar -->
<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
            <a href="{{ url('user/profile') }}" class="d-block text-decoration-none">{{ $name }}</a>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="{{ url('/dashboard') }}" class="nav-link text-decoration-none">
                    <i class="nav-icon fas fa-gauge"></i>
                    <p>
                        {{ __('Dashboard') }}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ url('/form') }}" class="nav-link text-decoration-none">
                    <i class="nav-icon fas fa-file-contract"></i>
                    <p>
                        {{ __('Assessment Form') }}
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ url('/result') }}" class="nav-link text-decoration-none">
                    <i class="nav-icon fas fa-folder"></i>
                    <p>
                        {{ __('Similarity Result') }}
                    </p>
                </a>
            </li>



            <li class="nav-item">
                <a href="{{ url('/about') }}" class="nav-link text-decoration-none">
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
