<aside id="left-panel" class="left-panel">
    <nav class="navbar navbar-expand-sm navbar-default">

        <div class="navbar-header">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>
            <a class="navbar-brand" href="/home">TokoSys</a>
            <a class="navbar-brand hidden" href="/home">TokoSys</a>
        </div>

        <div id="main-menu" class="main-menu collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="{{ url('home') }}"> 
                        <i class="menu-icon fa fa-home"></i>Dashboard 
                    </a>
                </li>

                <h3 class="menu-title">Transaksi</h3><!-- /.menu-title -->
                <li>
                    <a href="#">
                        <i class="menu-icon fa fa-sign-out"></i>Penjualan
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="menu-icon fa fa-sign-in"></i>Pembelian
                    </a>
                </li>

                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true"> <i class="menu-icon fa fa-book"></i>Laporan
                    </a>
                    <ul class="sub-menu children dropdown-menu">
                        <li><i class="fa fa-sign-out"></i><a href="#">Penjualan</a></li>
                        <li><i class="fa fa-sign-in"></i><a href="#">Pembelian</a></li>
                    </ul>
                </li>      

                <h3 class="menu-title">Master Data</h3><!-- /.menu-title -->
                <li>
                    <a href="{{ url('products')}}">
                        <i class="menu-icon fa fa-th"></i>Produk
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="menu-icon fa fa-tags"></i>Kategori Produk
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="menu-icon fa fa-briefcase"></i>Suplier
                    </a>
                </li>
                <li>
                    <a href="#">
                        <i class="menu-icon fa fa-smile-o"></i>Pelanggan
                    </a>
                </li>
                <li>
                    <a href="{{ url('users') }}">
                        <i class="menu-icon fa fa-users"></i>Pengguna
                    </a>
                </li>

                <h3 class="menu-title">Inventori</h3><!-- /.menu-title -->
                
            </ul>
        </div><!-- /.navbar-collapse -->
    </nav>
</aside><!-- /#left-panel -->

    