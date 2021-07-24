        <div>
          <!-- Footer -->
          <footer class="sticky-footer bg-white">
            <div class="container ">
              <div class="copyright text-center ">
                <span>Copyright &copy; STIKOM Yos Sudarso Purwokerto <?= date('Y'); ?></span>
              </div>
            </div>
          </footer>
          <!-- End of Footer -->
        </div>

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
          <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->
        <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Apakah Yakin Keluar?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
              </div>
              <div class="modal-body">Pilih "keluar" untuk mengakhiri program</div>
              <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                <a class="btn btn-primary" href="<?= base_url('auth/logout'); ?>">Keluar</a>
              </div>
            </div>
          </div>
        </div>

        <!-- Bootstrap core JavaScript-->
        <!-- <script src="<?= base_url('assets/') ?>vendor/jquery/jquery.min.js"></script> -->
        <script src="<?= base_url('assets/') ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

        <!-- Core plugin JavaScript-->
        <script src="<?= base_url('assets/') ?>vendor/jquery-easing/jquery.easing.min.js"></script>

        <!-- Custom scripts for all pages-->
        <script src="<?= base_url('assets/') ?>js/sb-admin-2.min.js"></script>

        <!-- <script src="<?= base_url('assets/'); ?>vendor/datatables/jquery.dataTables.min.js"></script>

        <script src="<?= base_url('assets/'); ?>vendor/datatables/dataTables.bootstrap4.min.js"></script> 

        <script src="//code.jquery.com/jquery-3.4.1.min.js"></script> -->
        <script src="//stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
        <script src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script src="//cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
        <script src="//cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
        <script src="//cdn.datatables.net/buttons/1.5.6/js/buttons.bootstrap4.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="//cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
        <script src="//cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
        <script src="//cdn.datatables.net/buttons/1.5.6/js/buttons.colVis.min.js"></script>


        <script>
          $(document).ready(function() {
            var table = $('#reminders').DataTable({
              //"dom": 'Blfrtip',
              "aLengthMenu": [
                [10, 25, 50, 100, 250, 500, -1],
                [10, 25, 50, 100, 250, 500, 'All']
              ],
              "oLanguage": {
                "sInfo": 'Total _TOTAL_ Data ditampilkan (_START_ sampai _END_)',
                "sLengthMenu": 'Tampilkan _MENU_ Data',
                "sInfoEmpty": 'Tidak ada Data.',
                "sSearch": 'Pencarian:',
                "sEmptyTable": 'Tidak ada Data di dalam Database',
                "sZeroRecords": 'Tidak ada data yang cocok',
                "sInfoFiltered": '(tersaring dari _MAX_ total data yang masuk)',
                "oPaginate": {
                  "sNext": 'Selanjutnya',
                  "sLast": 'Terakhir',
                  "sFirst": 'Pertama',
                  "sPrevious": 'Sebelumnya'
                }
              },

              "initComplete": function() {
                $("#reminders").show();
              },
              "buttons": ['copy', 'excel', 'pdf', 'print']
              //    bisa ditambah csv,colvis
            });
            table.buttons().container().appendTo(`#reminders_wrapper .col-md-6:eq(0)`);
          });
        </script>
        <script>
          $(document).ready(function() {
            var table = $('table.display').DataTable({
              //"dom": 'Blfrtip',
              "aLengthMenu": [
                [10, 25, 50, 100, 250, 500, -1],
                [10, 25, 50, 100, 250, 500, 'All']
              ],
              "oLanguage": {
                "sInfo": 'Total _TOTAL_ Data ditampilkan (_START_ sampai _END_)',
                "sLengthMenu": 'Tampilkan _MENU_ Data',
                "sInfoEmpty": 'Tidak ada Data.',
                "sSearch": 'Pencarian:',
                "sEmptyTable": 'Tidak ada Data di dalam Database',
                "sZeroRecords": 'Tidak ada data yang cocok',
                "sInfoFiltered": '(tersaring dari _MAX_ total data yang masuk)',
                "oPaginate": {
                  "sNext": 'Selanjutnya',
                  "sLast": 'Terakhir',
                  "sFirst": 'Pertama',
                  "sPrevious": 'Sebelumnya'
                }
              },

              "initComplete": function() {
                $("table.display").show();
              },
              "buttons": ['copy', 'excel', 'pdf', 'print']
              //    bisa ditambah csv,colvis
            });
            table.buttons().container().appendTo(`#reminders_wrapper .col-md-6:eq(0)`);
          });
        </script>

        <script type="text/javascript">
          $(document).ready(function() {
            var table = $('#dataTable').dataTable({

              "aLengthMenu": [
                [10, 25, 50, 100, 250, 500, -1],
                [10, 25, 50, 100, 250, 500, 'All']
              ],
              "oLanguage": {
                "sInfo": 'Total _TOTAL_ Data ditampilkan (_START_ sampai _END_)',
                "sLengthMenu": 'Tampilkan _MENU_ Data',
                "sInfoEmpty": 'Tidak ada Data.',
                "sSearch": 'Pencarian:',
                "sEmptyTable": 'Tidak ada Data di dalam Database',
                "sZeroRecords": 'Tidak ada data yang cocok',
                "sInfoFiltered": '(tersaring dari _MAX_ total data yang masuk)',
                "oPaginate": {
                  "sNext": 'Selanjutnya',
                  "sLast": 'Terakhir',
                  "sFirst": 'Pertama',
                  "sPrevious": 'Sebelumnya'
                }
              }
            });

          });
        </script>

        <!-- <script>
          $(document).ready(function() {
            $.noConflict();
            var table = $('#dataTable').DataTable();
          });
        </script> -->

        <script>
          $('.custom-file-input').on('change', function() {
            let fileName = $(this).val().split('\\').pop();
            $(this).next('.custom-file-label').addClass("selected").html(fileName);
          });


          $('.roleakses').on('click', function() {
            const menuId = $(this).data('menu');
            const roleId = $(this).data('role');

            $.ajax({
              url: "<?= base_url('admin/changeaccess'); ?>",
              type: 'post',
              data: {
                menuId: menuId,
                roleId: roleId
              },
              success: function() {
                document.location.href = "<?= base_url('admin/roleaccess/'); ?>" + roleId;
              }
            });
          });
        </script>

        <script>
          $('.aktifmhs').on('click', function() {
            const status = $(this).data('status');
            const nim = $(this).data('nim');

            $.ajax({
              url: "<?= base_url('operation/mahasiswaaccess'); ?>",
              type: 'post',
              data: {
                status: status,
                nim: nim
              },
              success: function() {
                document.location.href = "<?= base_url('operation/mahasiswa'); ?>";
              }
            });
          });
        </script>

        <script>
          $('.aktifpimp').on('click', function() {
            const status = $(this).data('status');
            const nidn = $(this).data('nidn');

            $.ajax({
              url: "<?= base_url('operation/pimpinanaccess'); ?>",
              type: 'post',
              data: {
                status: status,
                nidn: nidn
              },
              success: function() {
                document.location.href = "<?= base_url('operation/pimpinan'); ?>";
              }
            });
          });
        </script>

        <script>
          $('.aktifdsn').on('click', function() {
            const status = $(this).data('status');
            const nik = $(this).data('nik');

            $.ajax({
              url: "<?= base_url('operation/dosenaccess'); ?>",
              type: 'post',
              data: {
                status: status,
                nik: nik
              },
              success: function() {
                document.location.href = "<?= base_url('operation/dosen'); ?>";
              }
            });
          });
        </script>

        <script>
          $('.aktifsts').on('click', function() {
            const status = $(this).data('status');
            const id = $(this).data('id');

            $.ajax({
              url: "<?= base_url('dosen/statusAccess'); ?>",
              type: 'post',
              data: {
                status: status,
                id: id
              },
              success: function() {
                document.location.href = "<?= base_url('dosen/bimbingan'); ?>";
              }
            });
          });
        </script>

        <script type="text/javascript">
          $('#nim').on('change', function() {
            var nimCall = $('#nim').val();
            $.ajax({
              type: "GET",
              url: '../API/data/dataMahasiswa.php?nim=' + nimCall,
              contentType: 'application/json; charset=utf-8',
              dataType: 'json',
              success: function(data) {
                if (data == "data_found_datata") {
                  alert('Data Mahasiswa Sudah Terdaftar Didata Bimbingan, Ulangi Masukkan NIM');
                  $('#nim').val('');
                } else if (data == "data_mahasiswa_not_found") {
                  alert('Mahasiswa Belum Terdaftar Disistem, Silahkan Masukkan Data Mahasiswa Dahulu');
                  $('#nim').val('');
                } else {
                  var StringData = JSON.stringify(data);
                  var MahasiswaData = jQuery.parseJSON(StringData);
                  var mahasiswaDataPush = MahasiswaData.data;
                  mahasiswaDataPush.forEach(function(item, index, array) {
                    $('#nama').val(item.name);
                  });
                }
              }
            });
          });
        </script>
        <a class="scroll-to-top rounded" href="#page-top">
          <i class="fas fa-angle-up"></i>
        </a>

        <script type="text/javascript">
          $('#file_create_mhs_bimbingan').on('change', function() {
            console.clear();
            const dataCheck = $('#file_create_mhs_bimbingan').val();
            const fileCheck = dataCheck.split('.').pop();
            if (fileCheck == "docx" || fileCheck == "doc" || fileCheck == "pdf") {
              const fsize = $(this)[0].files[0].size / 1024 / 1024;
              if (fsize > 10) {
                alert("File terlalu besar, silahkan pilih dibawah 10mb");
                $('#file_data_create_mhs_bimbingan').val('');
                $('#file_create_mhs_bimbingan').val('');
                $('#label_file_create_mhs_bimbingan').html('Pilih Laporan');
              } else {
                var nim_create_mhs_bimbingan = $('#nim_create_mhs_bimbingan').val();
                var nama_create_mhs_bimbingan = $('#nama_create_mhs_bimbingan').val();
                var fd = new FormData();
                var files = $(this)[0].files[0];
                fd.append('file', files);
                $.ajax({
                  url: 'uploadFile?nim_create_mhs_bimbingan=' + nim_create_mhs_bimbingan + '&&nama_create_mhs_bimbingan=' + nama_create_mhs_bimbingan,
                  type: 'post',
                  data: fd,
                  contentType: false,
                  processData: false,
                  success: function(response) {
                    if (response != 0) {
                      $('#file_data_create_mhs_bimbingan').val(response);
                      $('#label_file_create_mhs_bimbingan').html(response);
                      $('#label_file_create_mhs_bimbingan').attr('style', 'width: 100%;white-space: nowrap;overflow: hidden;text-overflow: ellipsis;');
                    } else {
                      alert('Maaf, Tipe file tidak diijinkan silahkan pilih file tipe doc / docx / pdf');
                      $('#file_data_create_mhs_bimbingan').val('');
                      $('#file_create_mhs_bimbingan').val('');
                      $('#label_file_create_mhs_bimbingan').html('Pilih Laporan');
                    }
                  },
                });
              }
            } else {
              alert('Maaf, Tipe file tidak diijinkan silahkan pilih file tipe doc / docx / pdf');
              $('#file_data_create_mhs_bimbingan').val('');
              $('#file_create_mhs_bimbingan').val('');
              $('#label_file_create_mhs_bimbingan').html('Pilih Laporan');
            }
          });
        </script>

        <script type="text/javascript">
          $('#sendKegiatan').on('click', function() {
            var nim_create_mhs_bimbingan = $('#nim_create_mhs_bimbingan').val();
            var nama_create_mhs_bimbingan = $('#nama_create_mhs_bimbingan').val();
            var tanggal = $('#tanggal').val();
            var konsultasi = $('#konsultasi').val();
            var dosbing1 = $('#dosbing1').val();
            var dosbing2 = $('#dosbing2').val();
            var file_data_create_mhs_bimbingan = $('#file_data_create_mhs_bimbingan').val();

            if (tanggal == '' || tanggal == null) {
              alert('upload data gagal silahkan isi tanggal');
            } else if (konsultasi == '' || konsultasi == null) {
              alert('upload data gagal silahkan isi konsultasi');
            } else if (file_data_create_mhs_bimbingan == '' || file_data_create_mhs_bimbingan == null) {
              alert('upload data gagal silahkan select file upload');
            } else {
              var htmlData = '';
              htmlData += 'nim_create_mhs_bimbingan=' + nim_create_mhs_bimbingan + '&&nama_create_mhs_bimbingan=' + nama_create_mhs_bimbingan + '&&tanggal=' + tanggal + '&&konsultasi=' + konsultasi + '&&dosbing1=' + dosbing1 + '&&dosbing2=' + dosbing2 + '&&file_data_create_mhs_bimbingan=' + file_data_create_mhs_bimbingan;
              $.ajax({
                type: 'GET',
                url: '../API/data/createKegiatanMahasiswa.php?' + htmlData,
                success: function(response) {
                  console.log(response);
                  if (response == "error") {
                    alert('upload data gagal');
                    return false;
                  } else {

                  }
                }
              });
              location.reload();
              alert('upload data sukses');
            }
          });
        </script>
        <!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script> -->
        <script src="<?= base_url('assets/js/sweetalert/sweetalert2.all.min.js'); ?>"></script>
        <script src="<?= base_url('assets/js/scriptsweet.js'); ?>"></script>
        <script src="<?= base_url('assets/js/sweet2.js'); ?>"></script>
        <script src="<?= base_url('assets/js/sweet3.js'); ?>"></script>
        </body>

        </html>