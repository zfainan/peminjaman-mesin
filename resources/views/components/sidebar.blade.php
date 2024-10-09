<?php
$jabatan = auth()->user()->jabatan->nama_jabatan;
?>

<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="/">
        <div class="sidebar-brand-icon">
            <img src="https://sinarklatenmakmur.com/wp-content/uploads/2022/06/12-1.png" alt="" width="50px">
        </div>
        <div class="sidebar-brand-text mx-3">SKM</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item -->
    <li class="nav-item {{ Route::currentRouteName() === 'dashboard' ? 'active' : '' }}">
        <a class="nav-link" href="/">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    @if ($jabatan === \App\Enums\JabatanEnum::ADMIN->value || $jabatan === \App\Enums\JabatanEnum::KEPALA_LANE->value)
        <!-- Nav Item -->
        <li class="nav-item {{ Str::startsWith(Route::currentRouteName(), 'borrows.create') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('borrows.create') }}">
                <i class="fas fa-fw fa-people-carry"></i>
                <span>Pinjam Mesin</span></a>
        </li>

        <!-- Nav Item -->
        <li class="nav-item {{ Str::startsWith(Route::currentRouteName(), 'returns.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('returns.index') }}">
                <i class="fas fa-fw fa-history"></i>
                <span>Pengembalian Mesin</span></a>
        </li>
    @endif

    @if ($jabatan === \App\Enums\JabatanEnum::ADMIN->value || $jabatan === \App\Enums\JabatanEnum::PETUGAS_GUDANG->value)
        <!-- Nav Item -->
        <li class="nav-item {{ Str::startsWith(Route::currentRouteName(), 'borrows.index') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('borrows.index') }}">
                <i class="fas fa-fw fa-table"></i>
                <span>Data Peminjaman</span></a>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Master Data
        </div>

        <!-- Nav Item -->
        <li class="nav-item {{ Str::contains(Route::currentRouteName(), 'warehouses.') ? 'active' : '' }}">
            <a class="nav-link" href="/warehouses">
                <i class="fas fa-fw fa-warehouse"></i>
                <span>Data Gudang</span></a>
        </li>

        <!-- Nav Item -->
        <li class="nav-item {{ Str::contains(Route::currentRouteName(), 'engines.') ? 'active' : '' }}">
            <a class="nav-link" href="/engines">
                <i class="fas fa-fw fa-microscope"></i>
                <span>Data Mesin</span></a>
        </li>
    @endif

    @if ($jabatan === \App\Enums\JabatanEnum::ADMIN->value)
        <!-- Nav Item -->
        <li class="nav-item {{ Str::contains(Route::currentRouteName(), 'users.') ? 'active' : '' }}">
            <a class="nav-link" href="/users">
                <i class="fas fa-fw fa-users"></i>
                <span>Data Karyawan</span></a>
        </li>
    @endif

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="d-none d-md-inline text-center">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>
