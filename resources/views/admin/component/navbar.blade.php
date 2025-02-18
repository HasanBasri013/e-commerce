<nav class="main-header navbar navbar-expand navbar-orange navbar-dark fixed-top">
    <!-- Left navbar links -->
    <ul class="navbar-nav d-flex align-items-center">
        <li class="nav-item">
            <!-- Tombol untuk membuka dan menutup menu -->
            <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                <i class="fas fa-bars" style="margin-top: 5px;"></i>
            </a>
        </li>
    </ul>

    <ul class="navbar-nav ml-auto">
        <li class="nav-item dropdown">
            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                <i class="bi bi-person"></i> <!-- Bootstrap icon for user -->
                {{ Auth::user()->name }}
            </a>

            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();">
                    <i class="bi bi-box-arrow-right"></i> <!-- Bootstrap icon for logout -->
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
        </li>
    </ul>
</nav>
