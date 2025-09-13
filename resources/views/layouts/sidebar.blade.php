<div class="bg-light border-end" style="width: 250px; min-height: 100vh;">
    <h5 class="fw-bold mt-2 ps-4">Menu</h5>
    <hr class="sidebar-divider">
    <ul class="nav flex-column text-dark">
        <li class="nav-item mb-2">
            <a class="nav-link d-flex align-items-center text-dark {{ request()->routeIs('surat.index') ? 'fw-semibold' : '' }}"
                href="{{ route('surat.index') }}">
                <span class="me-2 d-flex align-items-center justify-content-center" style="width: 20px;">
                    &#9733;
                </span>
                <span>Arsip</span>
            </a>
        </li>
        <li class="nav-item mb-2">
            <a class="nav-link d-flex align-items-center text-dark {{ request()->routeIs('kategori.index') ? 'fw-semibold' : '' }}"
                href="{{ route('kategori.index') }}">
                <span class="me-2 d-flex align-items-center justify-content-center" style="width: 20px;">
                    &#9881;
                </span>
                <span>Kategori Surat</span>
            </a>
        </li>
        <li class="nav-item mb-2">
            <a class="nav-link d-flex align-items-center text-dark {{ request()->routeIs('about') ? 'fw-semibold' : '' }}"
                href="{{ route('about') }}">
                <span class="me-2 d-flex align-items-center justify-content-center" style="width: 20px;">
                    &#8505;
                </span>
                <span>About</span>
            </a>
        </li>
    </ul>
</div>