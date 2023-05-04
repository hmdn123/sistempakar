<div class="sidebar-menu">
    <ul class="menu">
        <li class="sidebar-title">Menu</li>

        <li class="sidebar-item {{ $title == 'Dashboard' ? 'active' : '' }}">
            <a href="/dashboard" class='sidebar-link'>
                <i class="bi bi-grid-fill"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li class="sidebar-item {{ $title == 'Master Akun' ? 'active' : '' }}">
            <a href="/indikator" class='sidebar-link'>
                <i class="bi bi-bag-plus-fill"></i>
                <span>Indikator</span>
            </a>
        </li>
        <li class="sidebar-item {{ $title == 'Master Akun' ? 'active' : '' }}">
            <a href="/master-akun" class='sidebar-link'>
                <i class="bi bi-bandaid-fill"></i>
                <span>Penyakit</span>
            </a>
        </li>
        <li class="sidebar-item {{ $title == 'Master Akun' ? 'active' : '' }}">
            <a href="/master-akun" class='sidebar-link'>
                <i class="bi bi-blockquote-right"></i>
                <span>Inputan Rull</span>
            </a>
        </li>
        <li class="sidebar-item {{ $title == 'Master Akun' ? 'active' : '' }}">
            <a href="/master-akun" class='sidebar-link'>
                <i class="bi bi-person-badge-fill"></i>
                <span>Data Pengguna</span>
            </a>
        </li>
        <li class="sidebar-item">
            <form action="{{ url('logout') }}" method="post">
                @csrf
                <button class="btn btn-primary" type="submit">
                    <i class="bi bi-person-fill-gear"></i>
                    Logout
                </button>
            </form>
        </li>
    </ul>
</div>
