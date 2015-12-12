<aside class="main-sidebar">
    <section class="sidebar">
      <div class="user-panel">
        <div class="pull-left image">
          <img src="https://avatars2.githubusercontent.com/u/6067158?v=3&s=140" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>{{Auth::user()->name}}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <ul class="sidebar-menu">
        <li class="header">NAVIGATION</li>
        <li class="treeview">
          <a href="{{ url() }}">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-user"></i>
            <span>Anggota</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('anggota/baru')}}"><i class="fa fa-user-plus"></i> Tambah Anggota</a></li>
            <li><a href="{{url('anggota')}}"><i class="fa fa-list"></i> Data Anggota</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-map-signs"></i>
            <span>Transaksi</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a><i class="fa fa-folder-open"></i> Simpanan
            <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="{{url('transaksi/simpanan/baru')}}"><i class="fa fa-plus"></i> Tambah Simpanan</a></li>
                <li><a href="{{url('transaksi/simpanan')}}"><i class="fa fa-list"></i> Data Simpanan</a></li>
              </ul>
            </li>
            <li><a><i class="fa fa-money"></i> Pinjaman
            <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="{{url('transaksi/pinjaman/baru')}}"><i class="fa fa-plus"></i> Buat Pinjaman</a></li>
                <li><a href="{{url('transaksi/pinjaman')}}"><i class="fa fa-list"></i> Data Pinjaman</a></li>
              </ul>
            </li>
            <li><a><i class="fa fa-money"></i> Angsuran
            <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a href="{{url('transaksi/pembayaran/baru')}}"><i class="fa fa-plus"></i> Pembayaran</a></li>
                <li><a href="{{url('transaksi/pembayaran/all')}}"><i class="fa fa-list"></i> Data Pembayaran</a></li>
              </ul>
            </li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-money"></i>
            <span>Keuangan</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a><i class="fa fa-pencil"></i> Koreksi
            <i class="fa fa-angle-left pull-right"></i></a>
              <ul class="treeview-menu">
                <li><a><i class="fa fa-institution"></i> Koperasi
                <i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu">
                    <li><a href="{{url('keuangan/pemasukan/koreksi')}}"><i class="fa fa-sign-in"></i> Pemasukan Koperasi</a></li>
                    <li><a href="{{url('keuangan/pengeluaran/koreksi')}}"><i class="fa fa-sign-out"></i> Pengeluaran Koperasi</a></li>
                  </ul>
                </li>
                <!--li><a><i class="fa fa-user"></i> Anggota
                <i class="fa fa-angle-left pull-right"></i></a>
                  <ul class="treeview-menu">
                    <li><a href="{{url('keuangan/pemasukan/anggota')}}"><i class="fa fa-sign-in"></i> Pemasukan Anggota</a></li>
                    <li><a href="{{url('keuangan/pengeluaran/anggota')}}"><i class="fa fa-sign-out"></i> Pengeluaran Anggota</a></li>
                  </ul>
                </li-->
              </ul>
            </li>
            <li><a href="{{url('keuangan/rekap')}}"><i class="fa fa-server"></i> Rekap Keuangan</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-copy"></i>
            <span>Laporan</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('laporan/simpanan')}}"><i class="fa fa-folder-open"></i> Simpanan</a></li>
            <li><a href="{{url('laporan/pinjaman')}}"><i class="fa fa-money"></i> Pinjaman</a></li>
            <li><a href="{{url('laporan/saldo')}}"><i class="fa fa-tachometer"></i> Saldo Koperasi</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-cubes"></i>
            <span>Preferensi</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('preferensi/simpanan')}}"><i class="fa fa-folder-open"></i> Simpanan</a></li>
            <li><a href="{{url('preferensi/pinjaman')}}"><i class="fa fa-money"></i> Pinjaman</a></li>
          </ul>
        </li>
        <li class="treeview">
          <a href="#">
            <i class="fa fa-cogs"></i>
            <span>Pengaturan</span>
            <i class="fa fa-angle-left pull-right"></i>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{url('pengaturan/koperasi')}}"><i class="fa fa-institution"></i> Koperasi</a></li>
            <li><a href="{{url('pengaturan/pengurus')}}"><i class="fa fa-group"></i> Pengurus</a></li>
            <li><a href="{{url('bantuan')}}"><i class="fa fa-life-ring"></i> Bantuan</a></li>
          </ul>
        </li>
      </ul>
    </section>
  </aside>