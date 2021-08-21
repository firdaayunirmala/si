<style>
  .chat-main {
    bottom: 0;
  }

  .chat-header {
    background: #E5EFC1;
    border: 1px solid #D7DF71;
  }

  .image img {
    height: 40px;
    width: 40px;
  }

  .user-detail h6 {
    display: inline-block;
  }

  .user-detail .active {
    color: #32B92D;
    font-size: 12px;
  }

  .options i {
    color: #a1a1a1;
    font-size: 19px;
    cursor: pointer;
  }

  .chat-content,
  .chat-content .sender,
  .user-detail h6 {
    font-size: 14px;
  }

  .chat-content ul {
    height: 260px;
    overflow-x: scroll;
    overflow-x: hidden;
  }

  .chat-content ul li {
    list-style: none;
    background: #F5F5F5;
  }

  .chat-content .msg-box {
    background: #e1e1e1;
  }

  .chat-content .msg-box .send-btn {
    background: #39AEA9;
  }

  .chat-content .time {
    font-size: 10px;
    color: #a1a1a1;
  }

  #isi_chat {
    height: 400px;
  }
</style>
<div class="container-fluid">
  <input type="hidden" id="nim" value="<?php echo $mhs->nim ?>" ;>

  <h1 class="h3 mb-2 text-gray-800"><?= $title; ?></h1>
  <div class="row">
    <div class="col-md-9 m-0 chat-main">
      <div class="card-mb-12">
        <div class="row">
          <div class="col-md-12 chat-header bg-white rounded-top p-2">
            <div class="form-group row">
              <label class="control-label col-md-2">Pilih Nama Dosen</label>
              <div class="col-md-6">
                <select id="pilihDosen" class="form-control">
                  <?php foreach ($target as $v) : ?>
                    <option value="<?= $v['value'] ?>"><?= $v['name'] ?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="row">
              <div class="col-md-3 image"><img src="<?= base_url('assets/img/profile/default.jpg') ?>" class="rounded"></div>
              <div class="col-md-5 user-detail pt-2">
                <h6 class="pt-1" id="dosenName"><?php echo $mhs->name ?></h6>
                <i class="fa fa-circle active ml-1" aria-hidden="true"></i>
              </div>
            </div>
          </div>

          <div class="col-md-12  chat-content p-0 bg-white border border-top-0">
            <ul class="pl-3 pr-3 pt-1 mb-1">
              <li class="p-2 mb-1 rounded" id="isi_chat"></li>
            </ul>
            <h6 class="text-center mb-2 sender font-italic"></h6>
            <div class="msg-box p-2">
              <div class="row">
                <form class="col-lg-12" id="form_pesan" method="POST">
                  <div class="row">
                    <div class="col-md-10">
                      <input type="hidden" name="user" id="user" value="<?php echo $mhs->user_id ?>" class="form-control">
                      <input type="hidden" name="target" id="target" value="" class="form-control">
                      <input type="text" class="form-control" placeholder="message ..." id="pesan" name="pesan">
                    </div>

                    <div class="col-md-2">
                      <input type="button" value="kirim" id="kirim" class="btn btn-md btn-primary">
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <a href="<?= base_url('mahasiswa/bimbingan'); ?>" class="btn btn-danger">Kembali</a>
</div>

<script>
  $(document).ready(function() {
    $("#pilihDosen").trigger('change')
    var e = jQuery.Event("keydown", {
      keyCode: 13
    });

    $('#pesan').on('keydown', function(e) {
      if (e.keyCode === 13) {
        var pesan = $('#pesan').val();
        e.preventDefault()
        var target = $('#target').val();
        var user = $('#user').val();
        $.ajax({
          type: "POST",
          url: "<?= site_url('Mahasiswa/kirim_chat'); ?>",
          data: 'pesan=' + pesan + '&user=' + user + '&target=' + target,
          success: function(data) {
            $('#pesan').val('');
            $('#isi_chat').html(data);
          }
        });
      }
    });

    $("#pesan").trigger(e);

    function scan() {
      alert('hello');
    }

    function tampildata() {
      var target = $('#target').val();
      var user = $('#user').val();
      $.ajax({
        type: "GET",
        url: "<?= site_url('Mahasiswa/ambil_pesan'); ?>",
        data: 'target=' + target + '&user=' + user,
        success: function(data) {

          $('#isi_chat').html(data);

        }
      });
    }

    $('#kirim').click(function() {
      var target = $('#target').val();
      var pesan = $('#pesan').val();
      var user = $('#user').val();
      $.ajax({
        type: "POST",
        url: "<?= site_url('Mahasiswa/kirim_chat'); ?>",
        data: 'pesan=' + pesan + '&user=' + user + '&target=' + target,
        dataType: 'json',
        success: function(data) {
          if (data.status == 200) {
            $('#pesan').val('');
            $('#isi_chat').html(data.data);
          } else {
            alert(data.message)
          }
        }
      });
    });

    setInterval(function() {
      tampildata();
    }, 5000);
  });

  $("#pilihDosen").change(function() {
    $('#target').val($(this).val())
    $('#dosenName').text($("#pilihDosen option:selected").text())
  })
</script>