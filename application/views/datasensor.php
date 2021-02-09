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
            <h4 class="card-title ">Database Sensor</h4>
            <p class="card-category">Data terkait bacaan sensor yang disimpan secara lengkap</p>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table id="DataSensor" class="table table-hover display nowrap">
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
      url: "<?php echo base_url(); ?>DataSensor/filter_tanggal",
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
        var table = $('#DataSensor').DataTable({
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
              "data": "kecepatanangin",
              "render": function(data, type, row, meta) {
                return `${row.kecepatanangin}m/s`;
              }
            },
            {
              "data": "statushujan",
              "render": function(data, type, row, meta) {
                if (`${row.statushujan}` == "0") {
                  return 'Tidak Hujan';
                } else {
                  return 'Hujan';
                }
              }
            },
            {
              "data": "suhu",
              "render": function(data, type, row, meta) {
                return `${row.suhu}*C`;
              }
            },
            {
              "data": "kelembaban",
              "render": function(data, type, row, meta) {
                return `${row.kelembaban}%`;
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
      $('#DataSensor').DataTable().destroy();
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