<body style="background-image: url('assets/img/bgstikom.jpg')" ; background-size: cover">
  <div class="container">

    <!-- Outer Row -->
    <div class="mt-5 row justify-content-center">
      <div class="col-lg-5">
        <div class="card my-5">
          <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
              <div class="col-lg">
                <div class="p-5">
                  <div class="text-center">
                    <h2 class="h4 text-gray-900 mb-4">Login Admin</h2>
                  </div>
                  <?php if ($this->session->flashdata('message')) : ?>
                    <?= $this->session->flashdata('message'); ?>
                    <?php unset($_SESSION['message']); ?>
                  <?php endif; ?>

                  <form class="user" method="post" action="?>= base_url('auth'); ?>">

                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Email" value="<?= set_value('email'); ?>">
                      <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>

                    <div class="form-group">
                      <input type="password" class="form-control form-control-user" id="password" name="password" placeholder="Password">
                      <input type="checkbox" onclick="myFunction()"> Lihat Password
                      <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                    </div>

                    <button type="submit" class="btn btn-primary btn-user btn-block">
                      Login
                    </button>
                    <a href="<?= base_url(); ?>home" class="btn btn-primary btn-user btn-block">
                      Logout
                    </a>


                    <!-- <hr> -->
                  </form>
                  <!-- <div class="text-center">
                    <a class="small" href="<?= base_url('auth/forgotpassword'); ?>">Forgot Password?</a>
                  </div>
                  <div class="text-center">
                    <a class="small" href="<?= base_url('auth/registration'); ?>">Create an Account!</a>
                  </div> -->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
    function myFunction() {
      var x = document.getElementById("password");
      if (x.type === "password") {
        x.type = "text";
      } else {
        x.type = "password";
      }
    }
  </script>