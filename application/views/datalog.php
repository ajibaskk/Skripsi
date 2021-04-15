<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12 col-md-12">

        <form class="row g-3 input-daterange">
          <div class="col-lg-3 col-md-6">
            <label for="start_date" class="form-label">Tanggal Awal</label>
            <input type="date" id="start_date" name="start_date" class="form-control" data-inputmask-alias="datetime" value="<?= set_value('start_date'); ?>">
          </div>
          <div class="col-lg-3 col-md-6">
            <label for="end_date" class="form-label">Tanggal Akhir</label>
            <input type="date" id="end_date" name="end_date" class="form-control" data-inputmask-alias="datetime" value="<?= set_value('end_date'); ?>">
          </div>
        </form>
        <div class="row g-3">
          <div class="col-lg-2">
            <label for="filter" class="form-label">Filter Berdasarkan Tanggal</label>
            <button type="submit" class="btn btn-info form-control" id="filter" name="filter">Filter</button>
          </div>
        </div>
        <div class="row g-3">
          <div class="col-lg-2">
            <label for="reset" class="form-label">Reset</label>
            <button type="submit" class="btn btn-danger form-control" id="reset" name="reset">Reset</button>
          </div>
        </div>

        <div class="card">
          <div class="card-header card-header-primary mb-3">
            <h4 class="card-title ">Data Log Kejadian Perubahan Posisi Jendela</h4>
            <p class="card-category">Data log ini menunjukkan perubahan-perubahan posisi jendela saat operasi otomatis yang terpengaruh oleh sensor ataupun manual berdasarkan masukan pengguna</p>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="DataLog" class="table table-hover display nowrap">
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
                    Jenis Operasi
                  </th>
                  <th>
                    Posisi Jendela 1
                  </th>
                  <th>
                    Posisi Jendela 2
                  </th>
                  <th>
                    Sensor Berpengaruh
                  </th>
                  <th>
                    Kecepatan Angin (m/s)
                  </th>
                  <th>
                    Treshold Kecepatan Angin (m/s)
                  </th>
                  <th>
                    Status Hujan (units untuk 10 bits)
                  </th>
                  <th>
                    Treshold Status Hujan (units untuk 10 bits)
                  </th>
                  <th>
                    Suhu Kamar (*C)
                  </th>
                  <th>
                    Treshold Suhu Kamar (*C)
                  </th>
                  <th>
                    Kelembaban Kamar (%)
                  </th>
                  <th>
                    Treshold Kelembaban Kamar (%)
                  </th>
                  <th>
                    Treshold Jam Buka
                  </th>
                  <th>
                    Treshold Jam Tutup
                  </th>
                </thead>
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
    $("#start_date").on("change", function() {
      $("#end_date").attr("min", $(this).val());
    });
    $("#end_date").on("change", function() {
      $("#start_date").attr("max", $(this).val());
    });
  });


  function fetch_data(start_date, end_date) {
    $.ajax({
      url: "<?php echo base_url(); ?>DataLog/filter_tanggal",
      type: "POST",
      data: {
        start_date: start_date,
        end_date: end_date
      },
      dataType: "json",
      success: function(data) {
        console.log(start_date);
        console.log(data);
        // Datatables
        var i = "1";
        var table = $('#DataLog').DataTable({
          "lengthChange": true,
          "dom": "<'row'<'col-sm-12 col-md-4'l><'col-sm-12 col-md-4'B><'col-sm-12 col-md-4'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
          "buttons": ['copy', 'csv', 'excel', 'pdf'],
          "data": data,
          // responsive
          //"responsive": true,
          "columns": [{
              "data": "id",
              "render": function(data, type, row, meta) {
                return i++;
              }
            },
            {
              "data": "waktu"
            },
            {
              "data": "tanggal",
              "render": function(data, type, row, meta) {
                return moment(`${row.tanggal}`).format('DD-MM-YYYY');
              }
            },
            {
              "data": "status_operasi",
              "render": function(data, type, row, meta) {
                return `${row.status_operasi}`;
              }
            },
            {
              "data": "posisi_jendela1",
              "render": function(data, type, row, meta) {
                return `${row.posisi_jendela1}`;
              }
            },
            {
              "data": "posisi_jendela2",
              "render": function(data, type, row, meta) {
                return `${row.posisi_jendela2}`;
              }
            },
            {
              "data": "sensor",
              "render": function(data, type, row, meta) {
                return `${row.sensor}`;
              }
            },
            {
              "data": "kecepatanangin",
              "render": function(data, type, row, meta) {
                return `${row.kecepatanangin}`;
              }
            },
            {
              "data": "t_kecepatanangin",
              "render": function(data, type, row, meta) {
                return `${row.t_kecepatanangin}`;
              }
            },
            {
              "data": "statushujan",
              "render": function(data, type, row, meta) {
                return `${row.statushujan}`;
              }
            },
            {
              "data": "t_statushujan",
              "render": function(data, type, row, meta) {
                return `${row.t_statushujan}`;
              }
            },
            {
              "data": "suhu",
              "render": function(data, type, row, meta) {
                return `${row.suhu}`;
              }
            },
            {
              "data": "t_suhu",
              "render": function(data, type, row, meta) {
                return `${row.t_suhu}`;
              }
            },
            {
              "data": "kelembaban",
              "render": function(data, type, row, meta) {
                return `${row.kelembaban}`;
              }
            },
            {
              "data": "t_kelembaban",
              "render": function(data, type, row, meta) {
                return `${row.t_kelembaban}`;
              }
            },
            {
              "data": "t_jambuka",
              "render": function(data, type, row, meta) {
                return `${row.t_jambuka}`;
              }
            },
            {
              "data": "t_jamtutup",
              "render": function(data, type, row, meta) {
                return `${row.t_jamtutup}`;
              }
            }
          ]
        });
      }
    });
  }
  fetch_data();


  $('#filter').click(function(e) {

    var start_date = $('#start_date').val();
    var end_date = $('#end_date').val();

    if (start_date != '' && end_date != '') {
      $('#DataLog').DataTable().destroy();
      fetch_data(start_date, end_date);
    } else {
      alert('Isi Kedua Tanggal!');
    }

  });

  $('#reset').click(function(e) {
    e.preventDefault();
    $("#start_date").val(''); // empty value
    $("#end_date").val('');

    $('#DataSensor').DataTable().destroy();
    fetch_data();
  });
</script>