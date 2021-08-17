<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800">Data Tugas Akhir</h1>
    <div class="row">
        <div class="col-lg">
      
        <div class="table-responsive">
                <table class="table table-bordered table-hover" id="data">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">JUDUL</th>
                            <th scope="col">PEMBIMBING 1</th>
                            <th scope="col">PEMBIMBING 2</th>
                        </tr>
                    </thead>
                    <tbody>
    
                        <?php foreach ($beranda as $ber) : ?>
                            <tr>
                                <td><?= $ber['judul']; ?></td>
                                <td>Anda Belum Memiliki Dosen Pembimbing 1</td>
                                <td>Anda Belum Memiliki Dosen Pembimbing 2</td>
                            </tr>
                          
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>