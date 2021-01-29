<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12 col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
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
                    Waktu
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
                    foreach ($datasensor as $data) {
                      echo '
                            <tr>
                              <td class="text-center align-middle">' . $data['id'] . '</td>
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
  });
</script>