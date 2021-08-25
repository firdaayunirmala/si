<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
  <?php if ($this->session->flashdata('message')) : ?>
    <?= $this->session->flashdata('message'); ?>
    <?php unset($_SESSION['message']); ?>
  <?php endif; ?>


  <div class="row" id="formData" style="display: none;">

    <div class="col-lg-12">
      <div class="card shadow">
        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
          <h6 class="m-0 font-weight-bold text-primary">
            Form Tambah Tugas Akhir</h6>
          <div class="float-rgiht">
            <button class="btn btn-sm btn-danger" type="button" onclick="$('#cancelData').click()"><i class="fa fa-times"></i></button>
          </div>
        </div>
        <div class="card-body">

          <?= form_open_multipart(); ?>
          <input type="hidden" name="datata_id" id="datata_id">
          <input type="hidden" name="aksi" id="aksi" value="tambah">
          <div class="form-group row" style="margin-top: 20px;">
            <label class="col-sm-3 col-form-label" for="tanggal">Tanggal </label>
            <div class="col-sm-6">
              <div class="input-group">
                <input name="tanggal" id="tanggal" type="date" class="form-control" placeholder="Periode Tanggal">
              </div>
            </div>
          </div>

          <div class="form-group row">
            <label for="jurusan_id" class="col-sm-3 col-form-label">Jurusan</label>
            <div class="col-sm-6">
              <select name="jurusan_id" id="jurusan_id" class="form-control">
                <option value="0" selected>Pilih Jurusan</option>
                <?php foreach ($jurusan as $j) : ?>
                  <option value="<?= $j['jurusan_id'] ?>"><?= $j['jurusan_nama'] ?></option>
                <?php endforeach; ?>
              </select>
            </div>
          </div>

          <div class="form-group row">
            <label for="nim" class="col-sm-3 col-form-label">NIM</label>
            <div class="col-sm-6">
              <input type="text" class="form-control" id="nim" name="nim" placeholder="Masukan NIM" value="" readonly>
            </div>
          </div>

          <div class="form-group row">
            <label for="namalengkap" class="col-sm-3 col-form-label">Nama Lengkap</label>
            <div class="col-sm-6">
              <select name="mhs_id" id="mhs_id" readonly class="form-control">
              </select>
            </div>
          </div>

          <div class="form-group row">
            <label for="judul" class="col-sm-3 col-form-label">Judul Skripsi</label>
            <div class="col-sm-6">
              <textarea class="form-control" id="judul" name="judul" placeholder="Masukan Judul Skripsi" value="<?= set_value('judul'); ?>"></textarea>
              <?= form_error('judul', ' <small class="text-danger pl-3">', '</small>'); ?>
            </div>
          </div>

          <div class="form-group row">
            <label for="sinopsis" class="col-sm-3 col-form-label">Sinopsis</label>
            <div class="col-sm-6">
              <input type="file" id="sinopsis" name="sinopsis" class="custom-file-input" id="customFile" required>
              <?= form_error('sinopsis', ' <small class="text-danger pl-3">', '</small>'); ?>
              <label class="custom-file-label" for="customFile">Choose File</label>
              <p class="text-gray-800 ml-6">*Pastikan file yang dipilih adalah file yang sesuai data mahasiswa!</p>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-sm-3 col-form-label">Dosen Pembimbing</label>
          </div>

          <div class="row">
            <div class="col-sm-9">
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <td class="text-center">No</td>
                    <td class="text-center">Nama Dosen Pembimbing</td>
                    <td class="text-center aksi" style="display: none;">Aksi</td>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td class="text-center">1</td>
                    <td>
                      <div class="form-group">
                        <input type="hidden" name="id_detail1" id="id_detail1">
                        <select name="pembimbing1" id="pembimbing1" class="form-control pembimbing">
                          <option value="0">Pilih Dosen Pembimbing 1</option>
                          <?php foreach ($dosen as $pembimbing1) : ?>
                            <option value="<?= $pembimbing1['dosen_id'] ?>"><?= $pembimbing1['name'] ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </td>
                    <td class="text-center aksi" style="display: none;">
                      <div class="form-group">
                        <select name="status_dosen1" id="status_dosen1" class="form-control">
                          <option value="0">Proses</option>
                          <option value="1">Disetujui</option>
                          <option value="2">Ditolak</option>
                        </select>
                      </div>
                    </td>
                  </tr>
                  <tr>
                    <td class="text-center">2</td>
                    <td>
                      <div class="form-group">
                        <input type="hidden" name="id_detail2" id="id_detail2">
                        <select name="pembimbing2" id="pembimbing2" class="form-control pembimbing">
                          <option value="0">Pilih Dosen Pembimbing 2</option>
                          <?php foreach ($dosen as $pembimbing2) : ?>
                            <option value="<?= $pembimbing2['dosen_id'] ?>"><?= $pembimbing2['name'] ?></option>
                          <?php endforeach; ?>
                        </select>
                      </div>
                    </td>
                    <td class="text-center aksi" style="display: none;">
                      <div class="form-group">
                        <select name="status_dosen2" id="status_dosen2" class="form-control">
                          <option value="0">Proses</option>
                          <option value="1">Disetujui</option>
                          <option value="2">Ditolak</option>
                        </select>
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

          <div class="form-group row justify-content-end">
            <div class="col-sm-9">
              <small class="text-danger" id="labelWajibIsiData"> Harap semua data yang di isi dengan benar ! </small>
              <br>
              <button type="button" class="btn btn-primary" id="saveData">Simpan</button>
              <button type="button" id="cancelData" class="btn btn-danger">Kembali</button>
            </div>
          </div>

          </form>
        </div>

      </div>

    </div>
  </div>

  <div class="row" id="listData">
    <div class="col-lg">
      <div class="card shadow">
        <div class="card-body">
          <?php if (validation_errors()) : ?>
            <div class="alert alert-danger" role="alert">
              <?= validation_errors(); ?> </div>
          <?php endif; ?>

          <button type="button" class="btn btn-success mb-3" id="tambahData">Tambah data tugas akhir</button>
          <div class="table-responsive">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="control-label col-md-3">Jurusan</label>
                  <div class="col-md-9">
                    <select name="f_jurusan_id" id="f_jurusan_id" class="form-control">
                      <?php foreach ($jurusan as $j) : ?>
                        <option value="<?= $j['jurusan_id'] ?>"><?= $j['jurusan_nama'] ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <table class="table table-bordered table-hover table-sm" id="table-container">
              <thead class="thead-dark">
                <tr>
                  <th class="text-center" width="5%" scope="col">No</th>
                  <th class="text-center" width="5%" scope="col">Tanggal</th>
                  <th class="text-center" width="10%" scope="col">Nama</th>
                  <th class="text-center" width="25%" scope="col">Judul</th>
                  <th class="text-center" width="15%" scope="col">Sinopsis</th>
                  <th class="text-center" width="10%" scope="col">DosPem 1</th>
                  <th class="text-center" width="10%" scope="col">DosPem 2</th>
                  <th class="text-center" width="5%" scope="col">Status</th>
                  <th class="text-center" width="10%" scope="col">Opsi</th>
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

<script>
  $("#tambahData").on('click', function() {
    resetForm()
    getMahasiswa($("#jurusan_id").val())
    $('#nim').val($("#mhs_id").select2().find(":selected").data("nim"))
    $("#formData").slideDown(500)
    $("#listData").slideUp(500)
  })

  $("#cancelData").on('click', function() {
    resetForm()
    $("#listData").slideDown(500)
    $("#formData").slideUp(500)
    loadTbl()
  })


  $("#mhs_id").select2()
  $(".pembimbing").select2()

  $("#mhs_id").on('select2:select', function(e) {
    $('#nim').val($("#mhs_id").select2().find(":selected").data("nim"))
  })


  // fungsi reset form
  function resetForm() {
    $("#formData").find("form")[0].reset()
    $("#aksi").val("add")
    $("#datata_id").val("")
    $("#nim").val("")
    $("#id_detail1").val("")
    $("#id_detail2").val("")
    $("#pembimbing1").select2('val', $("#pembimbing1").val())
    $("#pembimbing2").select2('val', $("#pembimbing2").val())
    $("#jurusan_id").removeAttr('disabled', 'disabled')
    $("#saveData").show()
    $("#labelWajibIsiData").show()
    $(".aksi").hide()
  }


  // fungsi muat ulang table-container
  function loadTbl() {
    $.ajax({
      url: "<?= base_url() ?>datata/get_data",
      dataType: "json",
      data: {
        jurusan_id: $("#f_jurusan_id").val()
      },
      success: function(res) {
        const datatable = $("#table-container").DataTable()
        datatable.clear().draw();
        datatable.rows.add(res); // Add new data
        datatable.columns.adjust().draw(); // Redraw the table-container
      }
    })
  }


  function set_val(id) {
    $.ajax({
      url: '<?= base_url() ?>datata/edit_datata/' + id,
      dataType: 'json',
      success: function(res) {
        if (!$.isEmptyObject(res.datata)) {
          const data = res.datata
          $("#aksi").val("edit")
          $("#datata_id").val(data.datata_id)
          $("#mhs_id").val(data.mhs_id)
          $("#tanggal").val(data.tanggal)
          $("#nim").val(data.nim)
          $("#mhs_id").html(`<option value="${data.mhs_id}" data-nim="${data.nim}">${data.nim} - ${data.name}</option>`)
          $("#judul").val(data.judul)
          $("#sinopsis").val(data.sinopsis)
          $("#jurusan_id").val(data.jurusan_id)
          $("#jurusan_id").attr('disabled', 'disabled')
          $("#id_detail1").val(data.id_detail1)
          $("#id_detail2").val(data.id_detail2)
          // $("#pembimbing1").val(data.id_dosen1)
          $("#pembimbing1").select2('val', data.id_dosen1)
          // $("#pembimbing2").val(data.id_dosen2)
          $("#pembimbing2").select2('val', data.id_dosen2)
          $("#status_dosen1").val(data.status_dosen1)
          $("#status_dosen2").val(data.status_dosen2)
          $(".aksi").show()
          $("#formData").slideDown(500)
          $("#listData").slideUp(500)
        }
      }
    })
  }


  function set_del(id) {
    Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      type: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
      if (result.value) {
        $.ajax({
          url: '<?= base_url() ?>datata/hapusdatata/' + id,
          success: function(res) {
            if (res) {
              Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
              )
              loadTbl()
            }
          }
        })
      }
    })
  }

  $("#jurusan_id").change(function() {
    getMahasiswa($(this).val())
  })

  $("#f_jurusan_id").change(function() {
    loadTbl()
  })


  // mengambil data mahasiswa
  const getMahasiswa = (jurusan_id) => {
    $.ajax({
      url: "<?= base_url() ?>datata/get_mahasiswa/" + jurusan_id,
      dataType: 'json',
      success: res => {
        let opt = '';
        if (res.length > 0) {
          $.each(res, (index, item) => {
            opt += `<option value="${item.mhs_id}" data-nim="${item.nim}">${item.nim} - ${item.name}</option>`
          })
          $("#mhs_id").html(opt)
        } else {
          $("#mhs_id").html(opt)
        }
      }
    })
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
        width: "5%",
        targets: [0]
      }, {
        width: "8%",
        targets: 1
      }, {
        width: "15%",
        targets: [2, 3, 4]
      }, {
        width: "13%",
        targets: [5, 6]
      }, {
        width: "6%",
        targets: -2
      }, {
        width: "10%",
        targets: -1
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

    $("#saveData").click(function() {
      let error = 0;
      let pesanError = "";
      const elementError = []


      if ($("#judul").val() == "") {
        pesanError += "Judul tidak boleh kosong<br>"
        error++;
        elementError.push('#judul')
      }


      if ($("#pembimbing1").val() == "0") {
        pesanError += "Pilih Dosen Pembimbing 1 Dahulu<br>"
        error++;
        elementError.push('#pembimbing1')
      }


      if ($("#pembimbing2").val() == "0") {
        pesanError += "Pilih Dosen Pembimbing 2 Dahulu<br>"
        error++;
        elementError.push('#pembimbing2')
      }


      if ($("#jurusan_id").val() == "0") {
        pesanError += "Pilih Jurusan Dahulu<br>"
        error++;
        elementError.push('#jurusan_id')
      }


      if ($("#tanggal").val() == "") {
        pesanError += "Isi dahulu tanggal pengisian data<br>"
        error++;
        elementError.push('#tanggal')
      }


      if ($("#pembimbing2").val() == $("#pembimbing1").val()) {
        pesanError += "Dosen 1 dan Dosen 2 Tidak Boleh Sama<br>"
        error++;
        elementError.push('#pembimbing1')
      }


      if (error > 0) {
        Swal.fire({
          type: 'error',
          title: 'Oops...',
          html: pesanError,
          confirmButtonColor: '#3085d6',
          confirmButtonText: 'Ok!'
        }).then((result) => {
          $(elementError[0]).focus()
        })
        return
      }
      $("#formData").find('form').submit()
    })
    $("#formData").find('form').submit(function(e) {
      let url = ""
      if ($("#aksi").val() == "add") {
        url = "<?= base_url() ?>datata/tambahdatata"
      } else {
        url = "<?= base_url() ?>datata/update_datata"
      }
      e.preventDefault()
      $.ajax({
        url: url,
        type: 'post',
        dataType: 'json',
        data: $(this).serialize(),
        success: function(res) {
          if (res.status == 201) {
            Swal.fire({
              type: 'success',
              title: 'Success',
              html: res.message,
              showConfirmButton: false,
              timer: 1500
            })
            $("#cancelData").click()
          } else {
            Swal.fire({
              type: 'error',
              title: 'Oops...',
              html: res.message,
            })

          }
        }
      })
    })
  })

  function preview(id) {
    $.ajax({
      url: '<?= base_url() ?>datata/get_detail/' + id,
      dataType: 'json',
      success: function(res) {
        if (!$.isEmptyObject(res.datata)) {
          const data = res.datata
          $("#aksi").val("")
          $("#datata_id").val(data.datata_id)
          $("#mhs_id").val(data.mhs_id)
          $("#tanggal").val(data.tanggal)
          $("#nim").val(data.nim)
          $("#mhs_id").html(`<option value="${data.mhs_id}" data-nim="${data.nim}">${data.nim} - ${data.name}</option>`)
          $("#judul").val(data.judul)
          $("#sinopsis").val(data.sinopsis)
          $("#jurusan_id").val(data.jurusan_id)
          $("#id_detail1").val(data.id_detail1)
          $("#id_detail2").val(data.id_detail2)
          // $("#pembimbing1").val(data.id_dosen1)
          $("#pembimbing1").select2('val', data.id_dosen1)
          // $("#pembimbing2").val(data.id_dosen2)
          $("#pembimbing2").select2('val', data.id_dosen2)
          $("#status_dosen1").val(data.status_dosen1)
          $("#status_dosen2").val(data.status_dosen2)
          $(".aksi").show()
          $("#saveData").hide()
          $("#labelWajibIsiData").hide()
          $("#formData").slideDown(500)
          $("#listData").slideUp(500)
        }
      }
    })
  }
</script>

</div>
<!-- End of Main Content -->