<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div class="card-header card-header-warning card-header-icon">
            <div class="card-icon">
              <i class="material-icons">ac_unit</i>
            </div>
            <p class="card-category">Batas Suhu Kamar</p>
            <h3 class="card-title" id="ukur_suhu"><?= $suhu ?></h3>
          </div>
          <div class="card-footer">
            <div class="stats">
              <button type="button" class="btn btn-info" onclick="ubah_suhu()">Ubah</button>
            </div>
            <input id="ubah_suhu" type="number" class="form-control" style="display: none;">
            <button id="simpan_suhu" type="button" class="btn btn-success" onclick="simpan_suhu()" style="display: none;">Simpan</button>
          </div>
        </div>
      </div>


      <div class="col-lg-6 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div class="card-header card-header-info card-header-icon">
            <div class="card-icon">
              <i class="material-icons">invert_colors</i>
            </div>
            <p class="card-category">Batas Kelembaban Kamar</p>
            <h3 class="card-title" id="ukur_kelembaban"><?= $kelembaban ?></h3>
          </div>
          <div class="card-footer">
            <div class="stats">
              <button type="button" class="btn btn-info" onclick="ubah_kelembaban()">Ubah</button>
            </div>
            <input id="ubah_kelembaban" type="number" class="form-control" style="display: none;">
            <button id="simpan_kelembaban" type="button" class="btn btn-success" onclick="simpan_kelembaban()" style="display: none;">Simpan</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<script>
  function ubah_kelembaban() {
    document.getElementById("ubah_kelembaban").style.display = "block";
    document.getElementById("simpan_kelembaban").style.display = "block";
  }

  function simpan_kelembaban() {
    var kelembaban = document.getElementById("ubah_kelembaban").value;
    $.ajax({
      type: "post",
      url: "<?php echo base_url(); ?>InputSensor/ubah_kelembaban ",
      data: {
        kelembaban: kelembaban
      },
      dataType: "json",
      success: function(response) {
        console.log(response);
        document.getElementById("ukur_kelembaban").innerHTML = kelembaban;
        document.getElementById("ubah_kelembaban").style.display = "none";
        document.getElementById("simpan_kelembaban").style.display = "none";
        Swal.fire(
          'Selamat',
          'Data sensor kelembaban berhasi diubah',
          'success'
        )
      }
    });
  }

  function ubah_suhu() {
    document.getElementById("ubah_suhu").style.display = "block";
    document.getElementById("simpan_suhu").style.display = "block";
  }

  function simpan_suhu() {
    var suhu = document.getElementById("ubah_suhu").value;
    $.ajax({
      type: "post",
      url: "<?php echo base_url(); ?>InputSensor/ubah_suhu ",
      data: {
        suhu: suhu
      },
      dataType: "json",
      success: function(response) {
        console.log(response);
        document.getElementById("ukur_suhu").innerHTML = suhu;
        document.getElementById("ubah_suhu").style.display = "none";
        document.getElementById("simpan_suhu").style.display = "none";
        Swal.fire(
          'Selamat',
          'Data sensor suhu berhasi diubah',
          'success'
        )
      }
    });
  }
</script>