<?php
require_once '../controller/studentController.php';

$studIC = base64_decode($_GET['studIC']);

$student = new studentController();
$data = $student->viewUser($studIC);

if(isset($_POST['update'])){
    $student->editUser();
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>I-Hadir | Add Student</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- Select2 -->
  <link rel="stylesheet" href="../plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">

  <style>
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }

    #readOnlyG{
      pointer-events:none;"
    }
    

  </style>

</head>
<body class="hold-transition sidebar-mini">
  <div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index.php" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="addStud.php" class="nav-link">Add Student</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button"><i
            class="fas fa-th-large"></i></a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <img src="../images/icon/IH-W-1.png" alt="I-Hadir Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">I-Hadir</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Student Profile
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="index.php" class="nav-link active">
                  <i class="fas fa-list nav-icon"></i>
                  <p>Student List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="addStud.php" class="nav-link">
                  <i class="fas fa-plus-circle nav-icon"></i>
                  <p>Add Student</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Student Registration</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">General Form</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">

          <div class="col-md-12">
            <!-- Student Registration Form -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Register Information</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="row">

                    <table class="table table-sm table-borderless" width="100%" >
                      <col style="width:10%">
                      <col style="width:29%">
                      <col style="width:2%">
                      <col style="width:5%">
                      <col style="width:15%">
                      <col style="width:20%">
                      <tbody>
                        <?php
                        foreach($data as $row){
                            ?>
                        <tr>
                          <td><label>Name: </label></td>
                          <td><input type="text" class="form-control" name="studName" value="<?=$row['studName']?>" readonly></td>
                          <td></td>
                          <td rowspan="5"><label>Student's Picture: </label></td>
                          <td rowspan="5">
                            <img  id="output" width="200px" height="180px" style="padding-left: 1em" src="data:image/jpg;base64,<?php echo base64_encode(file_get_contents($row['studPhoto']))?>"/>
                            <script>
                              var loadFile = function(event) {
                                var output = document.getElementById('output');
                                output.src = URL.createObjectURL(event.target.files[0]);
                              };
                            </script>

                          </td>
                          <td>
                            <div class="custom-file">

                              <input type="file" class="custom-file-input" name="studPhoto" onchange="loadFile(event)" accept="image/*">
                              <label class="custom-file-label" for="studPhoto" >Choose picture</label>
                              <input type="hidden" name="studPhoto2" value="<?=$row['studPhoto']?>">
                            </div>

                          </td>

                        </tr>
                        <tr>
                          <td><label>IC Number: </label></td>
                          <td><input type="number" class="form-control" name="studIC" value="<?=$row['studIC']?>" readonly></td>
                        </tr>
                        <tr>
                          <td><label>Tel No: </label></td>
                          <td><input type="text" class="form-control" name="studPhone" id="studPhone" value="<?=$row['studPhone']?>"  onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" required></td>
                        </tr>
                        <!-- <input type="tel" class="form-control" id="studPhone" placeholder="Eg: 0123456789" pattern="[0-9]{10,14}"> -->

                        <tr>
                          <td><label>Gender: </label></td>
                          <td>
                            <select class="form-control select2bs4" style="width: 100%;" name="studGender" disabled>
                              <option disabled selected> -- Select Gender -- </option>
                              <option value="Male" <?php if($row['studGender']=="Male") echo 'selected="selected"'; ?>>Male</option>
                              <option value="Female" <?php if($row['studGender']=="Female") echo 'selected="selected"'; ?>>Female</option>
                            </select>
                            <input type="hidden" name="studGender" value="<?=$row['studGender']?>">
                          </td>
                        </tr>

                        <tr>
                          <td><label>Class</label></td>
                          <td>
                            <select class="form-control select2bs4" style="width: 100%;" name="studClass">
                              <option disabled selected> -- Select Class -- </option>
                              <option value="1 Elite" <?php if($row['studClass']=="1 Elite") echo 'selected="selected"'; ?>>1 Elite</option>
                              <option value="1 Examplary" <?php if($row['studClass']=="1 Examplary") echo 'selected="selected"'; ?>>1 Examplary</option>
                              <option value="2 Elite" <?php if($row['studClass']=="2 Elite") echo 'selected="selected"'; ?>>2 Elite</option>
                              <option value="2 Examplary" <?php if($row['studClass']=="2 Examplary") echo 'selected="selected"'; ?>>2 Examplary</option>
                              <option value="3 Elite" <?php if($row['studClass']=="3 Elite") echo 'selected="selected"'; ?>>3 Elite</option>
                              <option value="3 Examplary" <?php if($row['studClass']=="3 Examplary") echo 'selected="selected"'; ?>>3 Examplary</option>
                            </select>
                          </td>
                        </tr>
                      </tbody>
                        </table>
                        <!-- /.col -->
                      </div>
                      <!-- /.row -->
                    </div>
                    <!-- /.card-body -->
                  </div>
                  <!-- /.card -->

                  <!-- Parents' Information Form -->
                  <div class="card card-info">
                    <div class="card-header">
                      <h3 class="card-title">Parents' Information</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <table class="table table-sm table-borderless " width="100%" >
                        <col style="width:10.2%">
                        <col style="width:33%">
                        <col style="width:2%">
                        <col style="width:10%">
                        <col style="width:38%">

                        <tr>
                          <td><label>Father's Name: </label></td>
                          <td><input type="text" class="form-control" name="pFatherName" value="<?=$row['pFatherName']?>" readonly></td>

                          <td></td>

                          <td><label>Mother's Name: </label></td>
                          <td><input type="text" class="form-control" name="pMotherName" value="<?=$row['pMotherName']?>" readonly></td>
                        </tr>

                        <tr>
                          <td><label>Father's IC</label></td>
                          <td><input type="number" class="form-control" name="pFatherIC" value="<?=$row['pFatherIC']?>" readonly></td>
                          <td></td>
                          <td><label>Mother's IC</label></td>
                          <td><input type="number" class="form-control" name="pMotherIC" value="<?=$row['pMotherIC']?>" readonly></td>
                        </tr>
                      </table>
                    </div>
                  </div>
                  <!-- /.card -->

                  <!-- Emergency Contact Detail Form -->
                  <div class="card card-secondary">
                    <div class="card-header">
                      <h3 class="card-title">Emergency Contact Detail</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                      <table class="table table-sm table-borderless " width="100%" >
                        <col style="width:10.2%">
                        <col style="width:33%">
                        <col style="width:2%">
                        <col style="width:10%">
                        <col style="width:38%">

                        <tr>
                          <td><label for="eName">Name: </label></td>
                          <td><input type="text" class="form-control" name="eName" value="<?=$row['eName']?>"></td>
                          <td></td>
                          <td></td>
                          <td></td>
                        </tr>
                        <tr>
                          <td><label for="eRelation">Relationship </label></td>
                          <td><input type="text" class="form-control" name="eRelation" value="<?=$row['eRelation']?>"></td>
                          <td></td>
                          <td></td>
                          <td></td>
                        </tr>
                        <tr>
                          <td><label for="eTel">Tel No: </label></td>
                          <td><input type="tel" class="form-control" name="eTel"value="<?=$row['eTel']?>" pattern="[0-9]{10,14}"></td>
                          <td></td>
                          <td></td>
                          <td></td>
                        </tr>
                        <?php } ?>
                      </table>
                    </div>
                    <!-- register end button -->
                    <div class="card-footer">
                      <button type="submit" class="btn btn-success float-right" name="update" value="UPDATE">Update</button>
                      <!-- <button type="submit" class="btn btn-default">Cancel</button> -->
                    </div>
                    <!-- /.card-footer -->
                  </div>
                  <!-- /.card -->
                </form>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

      <!-- /.content-wrapper -->
       <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 1.0
    </div>
    <strong>Copyright &copy; 2020 I-Hadir</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
    <!-- jQuery -->
    <script src="../plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Select2 -->
    <script src="../plugins/select2/js/select2.full.min.js"></script>
    <!-- Bootstrap4 Duallistbox -->
    <script src="../plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
    <!-- bs-custom-file-input -->
    <script src="../plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../dist/js/demo.js"></script>
    <script type="text/javascript">
      $(document).ready(function () {
        bsCustomFileInput.init();
      });
      $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
    $("readonlyselect").select2({disabled:readonly});

  })
</script>
</body>
</html>
