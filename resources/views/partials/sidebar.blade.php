<nav>
    <div class="logo-name">
        <div class="logo-image">
            <img src="/images/logo.webp"  alt="">
        </div>

        <span class="logo_name">Prediksi Saham</span>
    </div>

    <div class="menu-items">
        <ul class="nav-links">
            <li >
                <a href="/admin" class="{{ Request::is('/admin') ? 'active' : '' }}">
                    <i class="uil uil-estate"></i>
                    <span class="link-name">Beranda</span>
                </a>
            </li>
            <li >
                <a href="/admin/data-saham" class="{{ Request::is('/admin/data-saham') ? 'active' : '' }}">
                    <i class="uil uil-files-landscapes"></i>
                    <span class="link-name">Data Saham</span>
                </a>
            </li>
            <li >
                <a href="/admin/fuzzifikasi" class="{{ Request::is('/admin/fuzzifikasi') ? 'active' : '' }}">
                    <i class="uil uil-chart"></i>
                    <span class="link-name">Fuzzifikasi</span>
                </a>
            </li>
            <li >
                <a href="/admin/rekomendasi" class="{{ Request::is('/admin/rekomendasi') ? 'active' : '' }}">
                    <i class="uil uil-thumbs-up"></i>
                    <span class="link-name">Rekomendasi</span>
                </a>
            </li>
        </ul>
        

        <ul class="logout-mode">
            <li><a href="/">
                    <i class="uil uil-signout"></i>
                    <span class="link-name">Logout</span>
                </a></li>

            <li class="mode">
                <a href="#">
                    <i class="uil uil-moon"></i>
                    <span class="link-name">Dark Mode</span>
                </a>

                <div class="mode-toggle">
                    <span class="switch"></span>
                </div>
            </li>
        </ul>
    </div>
</nav>
