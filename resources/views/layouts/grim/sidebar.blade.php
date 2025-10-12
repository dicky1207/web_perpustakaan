<div class="main-sidebar">
  <aside id="sidebar-wrapper">
@if(auth()->user()->role_id === 1)
    <div class="sidebar-brand">
      <a href="{{ route('admin.dashboard.index') }}">Panel Admin</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="{{ route('admin.dashboard.index') }}">PA</a>
    </div>
    <ul class="sidebar-menu">
      <li class="{{ Request::segment(2) === 'dashboard' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.dashboard.index') }}"><i class="fas fa-home"></i>
          <span>Dashboard</span></a>
      </li>
      <li class="menu-header">Data Master</li>
      <li class="{{ Request::segment(2) === 'users' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.users.index') }}"><i class="fas fa-users"></i>
          <span>Pengguna</span></a>
      </li>
      <li class="{{ Request::segment(2) === 'book-types' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.book-types.index') }}"><i class="fas fa-tags"></i> <span>Kategori
            Buku</span></a>
      </li>
      <li class="{{ Request::segment(2) === 'books' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('admin.books.index') }}"><i class="fas fa-book-open"></i> <span>Buku</span></a>
      </li>
      <li
        class="nav-item dropdown {{ (Request::segment(2) === 'book-borrowers' ? 'active' : '') || Request::segment(2) === 'book-borrowers-history' ? 'active' : '' }}">
        <a href="#" class="nav-link has-dropdown"><i class="fas fa-handshake"></i> <span>Peminjaman</span></a>
        <ul class="dropdown-menu">
          <li class="{{ Request::segment(2) === 'book-borrowers' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.book-borrowers.index') }}">Peminjam Buku</a>
          </li>
          <li class="{{ Request::segment(2) === 'book-borrowers-history' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('admin.book-borrowers-history.index') }}">Histori Peminjam Buku</a>
          </li>
        </ul>
      </li>
    </ul>
@elseif(auth()->user()->role_id === 2)
    <div class="sidebar-brand">
      <a href="{{ route('operator.dashboard.index') }}">Panel Operator</a>
    </div>
    <div class="sidebar-brand sidebar-brand-sm">
      <a href="{{ route('operator.dashboard.index') }}">PO</a>
    </div>
    <ul class="sidebar-menu">
      <li class="{{ Request::segment(2) === 'dashboard' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('operator.dashboard.index') }}"><i class="fas fa-home"></i>
          <span>Dashboard</span></a>
      </li>
      <li class="menu-header">Data Master</li>
      <li class="{{ Request::segment(2) === 'book-types' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('operator.book-types.index') }}"><i class="fas fa-tags"></i> <span>Kategori
            Buku</span></a>
      </li>
      <li class="{{ Request::segment(2) === 'books' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('operator.books.index') }}"><i class="fas fa-book-open"></i> <span>Buku</span></a>
      </li>
      <li
        class="nav-item dropdown {{ (Request::segment(2) === 'book-borrowers' ? 'active' : '') || Request::segment(2) === 'book-borrowers-history' ? 'active' : '' }}">
        <a href="#" class="nav-link has-dropdown"><i class="fas fa-handshake"></i> <span>Peminjaman</span></a>
        <ul class="dropdown-menu">
          <li class="{{ Request::segment(2) === 'book-borrowers' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('operator.book-borrowers.index') }}">Peminjam Buku</a>
          </li>
          <li class="{{ Request::segment(2) === 'book-borrowers-history' ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('operator.book-borrowers-history.index') }}">Histori Peminjam Buku</a>
          </li>
        </ul>
      </li>
    </ul>
@else
      <div class="sidebar-brand">
        <a href="{{ route('anggota.dashboard.index') }}">Panel Anggota</a>
      </div>
      <div class="sidebar-brand sidebar-brand-sm">
        <a href="{{ route('anggota.dashboard.index') }}">PA</a>
      </div>
      <ul class="sidebar-menu">
        <li class="{{ Request::segment(2) === 'dashboard' ? 'active' : '' }}">
          <a class="nav-link" href="{{ route('anggota.dashboard.index') }}"><i class="fas fa-home"></i>
            <span>Dashboard</span></a>
        </li>

        <li class="menu-header">Menu</li>
        <li
          class="nav-item dropdown {{ (Request::segment(2) === 'book-borrowers' ? 'active' : '') || Request::segment(2) === 'book-borrowers-history' ? 'active' : '' }}">
          <a href="#" class="nav-link has-dropdown"><i class="fas fa-handshake"></i> <span>Peminjaman</span></a>
          <ul class="dropdown-menu">
            <li class="{{ Request::segment(2) === 'book-borrowers-history' ? 'active' : '' }}">
              <a class="nav-link" href="{{ route('anggota.book-borrowers-history.index') }}">Histori Peminjaman Buku</a>
            </li>
          </ul>
        </li>
      </ul>
      @endif
    </ul>

  </aside>
</div>
