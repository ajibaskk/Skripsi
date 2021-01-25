<body>
  <div class="wrapper ">
    <div class="sidebar" data-color="purple" data-background-color="white">
      <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
      <div class="logo">
        <a class="simple-text logo-mini">
          <?php echo SITE_NAME ?>
        </a>
      </div>
      <div class="sidebar-wrapper">
        <ul class="nav">
          <li class="nav-item <?php if (isset($dashboard)) echo 'active'; ?>">
            <a class="nav-link" href="<?= base_url(); ?>">
              <i class="material-icons">dashboard</i>
              <p>Dashboard</p>
            </a>
          </li>
          <!-- DataSensor -->
          <li class="nav-item <?php if (isset($datasensor)) echo 'active'; ?>">
            <a class="nav-link" href="<?= base_url('datasensor'); ?>">
              <i class="material-icons">receipt</i>
              <p>Data Sensor</p>
            </a>
          </li>
          <!-- Masukkan Sensor -->
          <li class="nav-item <?php if (isset($inputsensor)) echo 'active'; ?>">
            <a class="nav-link" href="<?= base_url('inputsensor'); ?>">
              <i class="material-icons">input</i>
              <p>Input Sensor</p>
            </a>
          </li>
        </ul>
      </div>
    </div>