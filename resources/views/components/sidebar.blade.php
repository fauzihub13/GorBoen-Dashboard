<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="#">GorBoen</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="#">OFH</a>
        </div>
        <ul class="sidebar-menu">

            <li class='{{ Request::is('/') ? 'active' : '' }}'>
                <a class="nav-link"
                    href="{{ url('/') }}"><i class="fas fa-solid fa-house"></i><span>Umum</span></a>
            </li>
            <li class="{{ Request::is('news*') ? 'active' : '' }}">
                <a class="nav-link"
                    href="{{ url('news') }}"><i class="fas fa-solid fa-folder-open"></i><span>Berita</span></a>
            </li>
            <li class="{{ Request::is('kebun*') ? 'active' : '' }}">
                <a class="nav-link"
                    href="{{ url('kebun') }}"><i class="fas fa-regular fa-leaf"></i><span>Kebun</span></a>
            </li>
            
        </ul>

    </aside>
</div>
