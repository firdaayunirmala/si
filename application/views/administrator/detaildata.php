<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Detail Data Tugas Akhir</h1>
    <a href="<?= base_url('datata'); ?>" class="btn btn-danger mb-2">Kembali</a>

    <div class="card mb-3 col-lg-8">
        <div class="row no-gutters">
            <div class="col-md-8">
                <div class="card-body">
                  <p class="card-title"><?= date('d F Y', strtotime($admin['tanggal'])); ?</p>
                    <h5 class="card-title"><?= $admin['name']; ?></h5>
                    <p class="card-text"><?= $admin['email']; ?></p>
                    <p class="card-text"><?= $admin['hp']; ?></p>
                </div>
            </div>
        </div>
    </div>

</div>
</div>
<!-- End of Main Content -->