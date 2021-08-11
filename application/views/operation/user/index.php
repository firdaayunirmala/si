<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

  <div class="row">
    <div class="col-lg">
      <div class="card shadow">
        <div class="card-body">

          <a href="" class="btn btn-success mb-3" data-toggle="modal" data-target="#userModal" onclick="getProfil()">Tambah User</a>

          <div class="table-responsive">

            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="control-label col-md-3">Jenis Akun</label>
                  <div class="col-md-9">
                    <select class="form-control" id="f_jenis_akun" name="f_jenis_akun">
                      <option value="1">Mahasiswa</option>
                      <option value="2">Dosen</option>
                    </select>
                  </div>
                </div>
              </div>
            </div>

            <table class="table table-bordered table-hover" id="table-container">
              <thead class="thead-dark">
                <tr>
                  <th class="text-center" scope="col">No</th>
                  <th class="text-center" scope="col">Username</th>
                  <th class="text-center" scope="col">User Fullname</th>
                  <th class="text-center" scope="col">Status</th>
                  <th class="text-center" scope="col">Opsi</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->


<!-- Modal -->
<div class="modal fade" id="userModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="userModalLabel">Form User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post">
        <input type="hidden" name="id" id="id">
        <div class="modal-body">
          <div class="form-group row">
            <label class="control-label col-md-3">Jenis Akun</label>
            <div class="col-md-9">
              <select class="form-control" id="jenis_akun" name="jenis_akun">
                <option value="1">Mahasiswa</option>
                <option value="2">Dosen</option>
              </select>
            </div>
            <div class="col-md-9" style="display: none;">
              <input type="text" class="form-control" id="jenis_akun_label" readonly>
            </div>
          </div>
          <div class="form-group row">
            <label class="control-label col-md-3">Profil</label>
            <div class="col-md-9">
              <select class="form-control" id="profil_id" name="profil_id">
                <option value=""></option>
              </select>
            </div>
            <div class="col-md-9" style="display: none;">
              <input type="text" class="form-control" id="profil_label" readonly>
            </div>
          </div>
          <div class="form-group row">
            <label class="control-label col-md-3">Username</label>
            <div class="col-md-9">
              <input type="text" class="form-control" id="user_name" name="user_name" placeholder="Username" required>
              <input type="hidden" class="form-control" id="user_name_lama" name="user_name_lama">
            </div>
          </div>
          <div class="form-group row">
            <div class="col-md-9 offset-md-3">
              <div class="form-check">
                <input type="checkbox" id="is_ganti_password" name="is_ganti_password">
                <label class="form-check-label" for="is_ganti_password">
                  Ganti Password?
                </label>
              </div>
            </div>
          </div>
          <div class="form-group row">
            <label class="control-label col-md-3">Password</label>
            <div class="col-md-9">
              <input type="password" class="form-control" id="password1" name="password1" placeholder="Password" required>
            </div>
          </div>
          <div class="form-group row">
            <label class="control-label col-md-3">Repeat Password</label>
            <div class="col-md-9">
              <input type="password" class="form-control" id="password2" name="password2" placeholder="Password" required>
            </div>
          </div>
          <div class="form-group row">
            <label class="control-label col-md-3">Status</label>
            <div class="col-md-9">
              <select class="form-control" id="is_active" name="is_active">
                <option value="1">Aktif</option>
                <option value="0">Non Aktif</option>
              </select>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
          <button type="button" name="tambah" id="tambahData" class="btn btn-primary">Simpan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
  function getProfil() {
    $.ajax({
      url: "<?= base_url() ?>operation/get_profil",
      data: {
        jenis_akun: $("#jenis_akun").val()
      },
      dataType: 'json',
      success: function(res) {
        let opt = '',
          selected = ''
        if (res.length > 0) {
          $.each(res, function(index, item) {
            opt += `<option value="${item.profil_id}">${item.profil_name}</option>`
          })
          $("#profil_id").html(opt)
        } else {
          $("#profil_id").html('')
        }
      }
    })
  }


  // fungsi muat ulang table-container
  function loadTbl() {
    $.ajax({
      url: "<?= base_url() ?>operation/get_data_user",
      data: {
        jenis_akun: $("#f_jenis_akun").val()
      },
      dataType: "json",
      success: function(res) {
        const datatable = $("#table-container").DataTable()
        datatable.clear().draw();
        datatable.rows.add(res); // Add new data
        datatable.columns.adjust().draw(); // Redraw the table-container
      }
    })
  }


  // f_jenis_akun on change
  $("#f_jenis_akun").change(function() {
    loadTbl()
  })


  // jenis_akun on change
  $("#jenis_akun").change(function() {
    getProfil()
  })


  $('#userModal').on('hidden.bs.modal', function() {
    resetForm();
  });


  // set value
  function set_val(data) {
    const isi = data.split('|')
    $("#id").val(isi[0]);
    $("#user_name").val(isi[1]);
    $("#is_active").val(isi[3]);
    $("#user_name_lama").val(isi[1]);
    $("#profil_id").closest('.col-md-9').hide();
    $("#profil_label").closest('.col-md-9').show();
    $("#profil_label").val(isi[2]);
    $("#jenis_akun").val($("#f_jenis_akun").val());
    $("#jenis_akun").closest('.col-md-9').hide();
    $("#jenis_akun_label").closest('.col-md-9').show();
    $("#jenis_akun_label").val($("#jenis_akun option:selected").text());
    $("input[type=password]").attr('disabled', 'disabled');
    $("#is_ganti_password").closest('.col-md-9').show()
    $("#userModal").modal('show')
  }


  // input is_ganti_password on change
  $("#is_ganti_password").change(function() {
    if ($(this).prop('checked')) {
      $("input[type=password]").removeAttr('disabled', 'disabled');
    } else {
      $("input[type=password]").attr('disabled', 'disabled');
    }
  })


  // hapus data
  function set_del(id) {
    if (confirm("Apakah Anda yakin ingin  menghapus data ini?")) {
      $.get("<?= base_url() ?>operation/hapususer/" + id + "/" + $("#f_jenis_akun").val(), function(res) {
        if (res) {
          loadTbl()
        }
      })
    }
  }


  // resetform
  function resetForm() {
    $("#userModal").find('form')[0].reset();
    $("#userModal").find('form').validate().resetForm();
    $("#jenis_akun").closest('.col-md-9').show();
    $("#jenis_akun_label").closest('.col-md-9').hide();
    $("#profil_label").closest('.col-md-9').hide();
    $("#profil_id").closest('.col-md-9').show();
    $("#id").val('');
    $("#user_name_lama").val('');

    $("#is_ganti_password").closest('.col-md-9').hide()
  }


  $(document).ready(function() {

    var table = $('#table-container').dataTable({
      "aLengthMenu": [
        [10, 25, 50, -1],
        [10, 25, 50, 'All']
      ],
      columnDefs: [{
        sClass: "text-center",
        targets: [0, -2, -1]
      }, {
        width: "10%",
        targets: [0]
      }, {
        width: "30%",
        targets: [1, 2]
      }, {
        width: "15%",
        targets: [-2, -1]
      }],
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
        $("#table-container").show();
      },
    });

    loadTbl()
    $("#profil_id").select2()

    $("#tambahData").click(function() {
      $("#userModal").find('form').submit()
    })

    $("#userModal").find('form').validate({
      ignore: 'input[type=hidden]',
      rules: {
        user_name: {
          required: true,
          remote: {
            url: "<?= base_url() ?>operation/cek_username",
            type: "post",
            data: {
              user_name: function() {
                return $("#user_name").val();
              },
              user_name_lama: function() {
                return $("#user_name_lama").val();
              },
              id: function() {
                return $("#id").val();
              },
            }
          }
        }
      },
      messages: {
        user_name: {
          remote: "Username sudah digunakan, buat username yang lain"
        }
      },
      submitHandler: function(form) {
        const url = $("#id").val() == '' ? "<?= base_url() ?>operation/tambahuser" : "<?= base_url() ?>operation/edituser"
        $.ajax({
          url: url,
          data: $(form).serialize(),
          dataType: 'json',
          type: 'post',
          success: function(res) {
            if (res) {
              $("#userModal").modal('hide')
              loadTbl()
            }
          }
        })
      }
    });
  })
</script>