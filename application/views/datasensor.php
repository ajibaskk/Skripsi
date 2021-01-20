<!doctype html>
<html lang="en">

<head>
  <?php $this->load->view("templates/head.php") ?>
</head>

<body>
  <div class="wrapper ">
    <?php $this->load->view("templates/sidebar.php") ?>
    <div class="main-panel">
      <!-- Navbar -->
      <?php $this->load->view("templates/navbar.php") ?>
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
          <!-- Content -->

        </div>
      </div>
      <?php $this->load->view("templates/footer.php") ?>
    </div>
  </div>

</body>

</html>