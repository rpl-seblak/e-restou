<div class="main-sidebar">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="#">E-RESTOU</a>
          </div>
          <div class="sidebar-brand sidebar-brand-sm">
            <a href="#">EU</a>
          </div>
          <ul class="sidebar-menu">
              <li class="menu-header">Menu</li>
              <li class="nav-item">
                <a href="#" class="nav-link"><i class="fas fa-fire"></i><span>Dashboard</span></a>
              </li>
              @if(Auth::user()->role == 'admin' ||Auth::user()->role == 'koki' )
              <li class="nav-item">
                <a href="#" class="nav-link"><i class="fas fa-utensils"></i><span>Data Menu</span></a>
              </li>
              @endif
              <!-- <li class="nav-item">
                <a href="#" class="nav-link"><i class="fa fa-users"></i><span>Data Pegawai</span></a>
              </li> -->
              @if(Auth::user()->role == 'pelayan')
              <li class="nav-item">
                <a href="{{ route('pelayan.meja') }}" class="nav-link"><i class="fas fa-table"></i><span>Data Meja</span></a>
              </li>  
              @endif
              @if(Auth::user()->role != 'kasir')
              <li class="nav-item">
                <a href="#" class="nav-link"><i class="fas fa-clipboard-list"></i><span>Data Pesanan</span></a>
              </li>
              @endif
              <!-- <li class="nav-item">
                <a href="#" class="nav-link"><i class="fas fa-shopping-bag"></i><span>Data Transaksi</span></a>
              </li> -->
              @if(Auth::user()->role == 'kasir')
              <li class="nav-item">
                <a href="#" class="nav-link"><i class="fas fa-file-invoice"></i><span>Data Tagihan</span></a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link"><i class="fas fa-wallet"></i><span>Pembayaran</span></a>
              </li>
              @endif
            </ul>           
        </aside>
      </div>