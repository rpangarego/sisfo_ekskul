<!-- Sidebar Nav -->
<div class="collapse navbar-collapse" id="sidenav-collapse-main">
    <!-- Nav items -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link <?=checkMenuActive('index')?>" href="index">
            <i class="ni ni-tv-2"></i>
            <span class="nav-link-text">Halaman Utama</span>
            </a>
        </li>

        <?php if ($_SESSION['status'] == 'admin' || $_SESSION['status'] == 'pengurus' || $_SESSION['status'] == 'kepsek' || $_SESSION['status'] == 'siswa') : ?>
            <li class="nav-item">
                <a class="nav-link <?=checkMenuActive('postingan')?>" href="index?m=postingan">
                <i class="ni ni-tv-2"></i>
                <span class="nav-link-text">Postingan</span>
                </a>
            </li>
        <?php endif ?>

        <?php if ($_SESSION['status'] == 'admin' || $_SESSION['status'] == 'wakepsek' || $_SESSION['status'] == 'kepsek' || $_SESSION['status'] == 'siswa') : ?>
        <li class="nav-item">
            <a class="nav-link <?=checkMenuActive('ekskul')?>" href="index?m=ekskul">
            <i class="ni ni-tv-2"></i>
            <span class="nav-link-text">Ekstrakurikuler</span>
            </a>
        </li>
        <?php endif ?>

        <?php if ($_SESSION['status'] == 'admin' || $_SESSION['status'] == 'pengurus' || $_SESSION['status'] == 'kepsek' || $_SESSION['status'] == 'siswa') : ?>
            <li class="nav-item">
                <a class="nav-link <?=checkMenuActive('presensi')?>" href="index?m=presensi">
                <i class="ni ni-tv-2"></i>
                <span class="nav-link-text">Presensi</span>
                </a>
            </li>
        <?php endif ?>

        <?php if ($_SESSION['status'] == 'admin' || $_SESSION['status'] == 'pengurus') : ?>
            <li class="nav-item">
                <a class="nav-link <?=checkMenuActive('peserta')?>" href="index?m=peserta">
                <i class="ni ni-tv-2"></i>
                <span class="nav-link-text">Peserta</span>
                </a>
            </li>
        <?php endif ?>

        <?php if ($_SESSION['status'] == 'admin' || $_SESSION['status'] == 'wakepsek') : ?>
            <li class="nav-item">
                <a class="nav-link <?=checkMenuActive('pengurus')?>" href="index?m=pengurus">
                <i class="ni ni-tv-2"></i>
                <span class="nav-link-text">Pengurus</span>
                </a>
            </li>
        <?php endif ?>

        <?php if ($_SESSION['status'] == 'admin' || $_SESSION['status'] == 'wakepsek') : ?>
            <li class="nav-item">
                <a class="nav-link <?=checkMenuActive('siswa')?>" href="index?m=siswa">
                <i class="ni ni-tv-2"></i>
                <span class="nav-link-text">Siswa</span>
                </a>
            </li>
        <?php endif ?>

        <?php if ($_SESSION['status'] == 'admin') : ?>
            <li class="nav-item">
                <a class="nav-link <?=checkMenuActive('pengguna')?>" href="index?m=pengguna">
                <i class="ni ni-tv-2"></i>
                <span class="nav-link-text">Pengguna</span>
                </a>
            </li>
        <?php endif ?>
    </ul>
</div>