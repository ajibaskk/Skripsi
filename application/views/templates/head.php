<!DOCTYPE html>
<html>

<head>
  <style>
    th {
      text-align: center;
    }

    td {
      text-align: center;
    }

    tr {
      text-align: center;
    }
  </style>
  <title><?php echo SITE_NAME . ": " . $title ?></title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- Material Kit CSS -->
  <link rel="stylesheet" href="<?= base_url("assets/css/material-dashboard.css?v=2.1.2"); ?>" />
  <!-- Bootstrap 5 -->
  <link rel="stylesheet" href="<?= base_url("plugins/bootstrap/css/bootstrap.css"); ?>">
  <link rel="stylesheet" href="<?= base_url("plugins/datatables/DataTables-1.10.23/css/dataTables.bootstrap4.min.css"); ?>">
  <script src="<?= base_url("plugins/bootstrap/js/jquery.min.js"); ?>">
  </script>
  <script src="<?= base_url("plugins/bootstrap/js/bootstrap.bundle.min.js"); ?>"></script>
  <!-- DataTables -->
  <script src="<?= base_url("plugins/datatables/DataTables-1.10.23/js/jquery.dataTables.min.js"); ?>"></script>
  <script src="<?= base_url("plugins/datatables/DataTables-1.10.23/js/dataTables.bootstrap4.min.js"); ?>"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/jszip-2.5.0/dt-1.10.20/b-1.6.1/b-flash-1.6.1/b-html5-1.6.1/b-print-1.6.1/r-2.2.3/datatables.min.js"></script>
  <!-- Buttons 
    -->
  <script src="<?= base_url("plugins/datatables/Buttons-1.6.5/js/dataTables.buttons.min.js"); ?>"></script>
  <script src="<?= base_url("plugins/datatables/Buttons-1.6.5/js/buttons.bootstrap4.min.js"); ?>"></script>
  <script src="<?= base_url("plugins/datatables/JSZip-2.5.0/jszip.min.js"); ?>"></script>
  <script src="<?= base_url("plugins/datatables/pdfmake-0.1.36/pdfmake.min.js"); ?>"></script>
  <script src="<?= base_url("plugins/datatables/pdfmake-0.1.36/vfs_fonts.js"); ?>"></script>
  <script src="<?= base_url("plugins/datatables/Buttons-1.6.5/js/buttons.html5.min.js"); ?>"></script>
  <script src="<?= base_url("plugins/datatables/Buttons-1.6.5/js/buttons.print.min.js"); ?>"></script>
  <script src="<?= base_url("plugins/datatables/Buttons-1.6.5/js/buttons.colVis.min.js"); ?>"></script>
  <link rel="stylesheet" href="<?= base_url("plugins/datatables/Buttons-1.6.5/css/buttons.bootstrap4.min.css"); ?>">
</head>