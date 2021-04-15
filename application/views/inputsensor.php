<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div class="card-header card-header-warning card-header-icon">
            <div class="card-icon">
              <i class="material-icons">thermostat</i>
            </div>
            <p class="card-category">Batas Suhu Kamar</p>
            <p class="card-category">Dalam Satuan Derajat Celcius</p>
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
            <p class="card-category">Dalam Satuan % (Persen)</p>
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

      <div class="col-lg-6 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div class="card-header card-header-danger card-header-icon">
            <div class="card-icon">
              <i class="material-icons">gesture</i>
            </div>
            <p class="card-category">Batas Status Hujan</p>
            <p class="card-category">Dalam Satuan Units dalam 10 bits (1-1024)</p>
            <p class="card-category">Semakin Rendah Menandakan Hujan</p>
            <h3 class="card-title" id="ukur_hujan"><?= $hujan ?></h3>
          </div>
          <div class="card-footer">
            <div class="stats">
              <button type="button" class="btn btn-info" onclick="ubah_hujan()">Ubah</button>
            </div>
            <input id="ubah_hujan" type="number" class="form-control" style="display: none;">
            <button id="simpan_hujan" type="button" class="btn btn-success" onclick="simpan_hujan()" style="display: none;">Simpan</button>
          </div>
        </div>
      </div>

      <div class="col-lg-6 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div class="card-header card-header-success card-header-icon">
            <div class="card-icon">
              <i class="material-icons">query_builder</i>
            </div>
            <p class="card-category">Batas Jam Operasi Otomatis</p>
            <p class="card-category">Membatasi Waktu Jendela untuk dapat Beroperasi Otomatis</p>
            <p class="card-category">Dalam Waktu 24 jam</p>
            <br>
            <p class="card-category">Jam Mulai Operasi Otomatis</p>
            <h3 class="card-title" id="jam_buka"><?= $jam_buka ?></h3>
            <p class="card-category">Jam Akhir Operasi Otomatis</p>
            <h3 class="card-title" id="jam_tutup"><?= $jam_tutup ?></h3>
          </div>
          <div class="card-footer">
            <div class="stats">
              <button type="button" class="btn btn-info" onclick="ubah_waktu()">Ubah</button>
            </div>
            <p id="ubah_jam_buka_tag" style="display: none;">Jam Mulai:</p>
            <input id="ubah_jam_buka" type="time" class="form-control center" style="display: none;">
            <p id="ubah_jam_tutup_tag" style="display: none;">Jam Selesai:</p>
            <input id="ubah_jam_tutup" type="time" class="form-control " style="display: none;">
            <button id="simpan_waktu" type="button" class="btn btn-success" onclick="simpan_waktu()" style="display: none;">Simpan</button>
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
          'Batas sensor kelembaban berhasil diubah',
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
          'Batas sensor suhu berhasil diubah',
          'success'
        )
      }
    });
  }

  function ubah_hujan() {
    document.getElementById("ubah_hujan").style.display = "block";
    document.getElementById("simpan_hujan").style.display = "block";
  }

  function simpan_hujan() {
    var hujan = document.getElementById("ubah_hujan").value;
    $.ajax({
      type: "post",
      url: "<?php echo base_url(); ?>InputSensor/ubah_hujan ",
      data: {
        hujan: hujan
      },
      dataType: "json",
      success: function(response) {
        console.log(response);
        document.getElementById("ukur_hujan").innerHTML = hujan;
        document.getElementById("ubah_hujan").style.display = "none";
        document.getElementById("simpan_hujan").style.display = "none";
        Swal.fire(
          'Selamat',
          'Batas sensor hujan berhasil diubah',
          'success'
        )
      }
    });
  }

  function ubah_waktu() {
    document.getElementById("ubah_jam_buka_tag").style.display = "block";
    document.getElementById("ubah_jam_buka").style.display = "block";
    document.getElementById("ubah_jam_tutup_tag").style.display = "block";
    document.getElementById("ubah_jam_tutup").style.display = "block";
    document.getElementById("simpan_waktu").style.display = "block";
  }

  function simpan_waktu() {
    var jam_buka = document.getElementById("ubah_jam_buka").value;
    var jam_tutup = document.getElementById("ubah_jam_tutup").value;
    $.ajax({
      type: "post",
      url: "<?php echo base_url(); ?>InputSensor/ubah_waktu ",
      data: {
        jam_buka: jam_buka,
        jam_tutup: jam_tutup
      },
      dataType: "json",
      success: function(response) {
        console.log(response);
        document.getElementById("jam_buka").innerHTML = jam_buka + ':00';
        document.getElementById("jam_tutup").innerHTML = jam_tutup + ':00';
        document.getElementById("ubah_jam_buka_tag").style.display = "none";
        document.getElementById("ubah_jam_buka").style.display = "none";
        document.getElementById("ubah_jam_tutup_tag").style.display = "none";
        document.getElementById("ubah_jam_tutup").style.display = "none";
        document.getElementById("simpan_waktu").style.display = "none";
        Swal.fire(
          'Selamat',
          'Batas Jam berhasil diubah',
          'success'
        )
      }
    });
  }
</script>