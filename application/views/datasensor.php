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
                    Suhu dan Kelembaban Kamar
                  </th>
                </thead>
                <tbody>
                  <tr>
                    <td>
                      1
                    </td>
                    <td>
                      14:32
                    </td>
                    <td>
                      12 Januari 2021
                    </td>
                    <td>
                      Dakota Rice
                    </td>
                    <td>
                      Niger
                    </td>
                    <td>
                      Oud-Turnhout
                    </td>
                  </tr>
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