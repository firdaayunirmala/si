<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800">Daftar Mahasiswa Bimbingan Tugas Akhir</h1>
    <div class="row">
        <div class="col-lg">
      
        <div class="table-responsive">
                <table class="table table-bordered table-hover" id="data">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">NIM</th>
                            <th scope="col">NAMA MAHASISWA</th>
                            <th scope="col">JUDUL</th>
                            <th scope="col">SINOPSIS</th>
                            <th scope="col">PEMBIMBING KE</th>
                        </tr>
                    </thead>
                    <tbody>
    
                        <?php foreach ($beranda as $ber) : ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td><?= $ber['judul']; ?></td>
                                <td><?= $ber['sinopsis']; ?></td>
                                <td>1</td>
                            </tr>
                          
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
</div>