<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12 col-md-12">

        <form class="row g-3 input-daterange">
          <div class="col-md-3">
            <label for="start_date" class="form-label">Tanggal Awal</label>
            <input type="date" id="start_date" name="start_date" class="form-control" data-inputmask-alias="datetime" placeholder="dd/mm/yyyy" value="<?= set_value('start_date'); ?>">
          </div>
          <div class="col-md-3">
            <label for="end_date" class="form-label">Tanggal Akhir</label>
            <input type="date" id="end_date" name="end_date" class="form-control" data-inputmask-alias="datetime" placeholder="dd/mm/yyyy" value="<?= set_value('end_date'); ?>">
          </div>
        </form>
        <div class="row g-3">
          <div class="col-md-2">
            <label for="date_button" class="form-label">Filter Berdasarkan Tanggal</label>
            <button type="submit" class="btn btn-info form-control" id="filter" name="filter">Cari</button>
          </div>
        </div>

        <div class="card">
          <div class="card-header card-header-primary mb-3">
            <h4 class="card-title ">Database Sensor</h4>
            <p class="card-category">Data terkait bacaan sensor yang disimpan secara lengkap</p>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="DataSensor" class="table table-hover">
                <thead class=" text-primary">
                  <th>
                    No
                  </th>
                  <th>
                    Waktu
                  </th>
                  <th>
                    Tanggal
                  </th>
                  <th>
                    Kecepatan Angin
                  </th>
                  <th>
                    Status Hujan
                  </th>
                  <th>
                    Suhu Kamar
                  </th>
                  <th>
                    Kelembaban Kamar
                  </th>
                </thead>
                <tbody>
                  <?php
                  if ($datasensor) {
                    $i = 1;
                    foreach ($datasensor as $data) {
                      echo '
                            <tr>
                              <td class="text-center align-middle">' . $i . '</td>
                              <td class="text-center align-middle">' . $data['waktu'] . '</td>
                              <td class="text-center align-middle">' . date("d/m/Y", strtotime($data['tanggal'])) . '</td>
                              <td class="text-center align-middle">' . $data['kecepatanangin'] . '</td>';
                      if ($data['statushujan'] == 0) {
                        echo '<td class="text-center align-middle">Tidak Hujan</td>';
                      } else if ($data['statushujan'] == 1) {
                        echo '<td class="text-center align-middle">Hujan</td>';
                      }
                      echo '
                              <td class="text-center align-middle">' . $data['suhu'] . '</td>
                              <td class="text-center align-middle">' . $data['kelembaban'] . '</td>
                              </td>
                            </tr>
                          ';
                      $i++;
                    }
                  }
                  ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    var table = $('#DataSensor').DataTable({
      lengthChange: true,
      buttons: ['copy', 'csv', 'excel', 'pdf']
    });

    table.buttons().container()
      .appendTo('#DataSensor_wrapper .col-md-6:eq(0)');

    $("#start_date").on("change", function() {
      $("#end_date").attr("min", $(this).val());
    });
    $("#end_date").on("change", function() {
      $("#start_date").attr("max", $(this).val());
    });
  });

  function fetch_data(start_date = '', end_date = '') {
    var dataTable = $('#DataSensor').DataTable({
      "processing": true,
      "serverSide": true,
      "order": [],
      "ajax": {
        url: "<?php echo base_url(); ?>DataSensor/filter_tanggal",
        type: "POST",
        data: {
          start_date: start_date,
          end_date: end_date
        },
        success: function(data) {
          console.log(data);
          $('#DataSensor').html(data);
        }
      }
    });
  }

  $('#filter').click(function() {

    var start_date = $('#start_date').val();
    var end_date = $('#end_date').val();

    if (start_date != '' && end_date != '') {
      $('#DataSensor').DataTable().destroy();
      fetch_data(start_date, end_date);
    } else {
      alert('Isi Kedua Tanggal!');
    }

  });
</script>