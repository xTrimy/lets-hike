<?php
include('includes/head.php');
if (!Login::isLoggedIn()) {
  echo '<script>window.location="404.php"</script>';
}


if (isset($_GET["action"])) 
{
  if ($_GET["action"] == "delete") 
  {
    DB::query('DELETE FROM login_tokens WHERE user_id=:id',array(':id'=>$_GET["id"]));
    DB::query('DELETE FROM tickets_messages WHERE user_id=:id',array(':id'=>$_GET["id"]));
    DB::query('DELETE FROM users WHERE id=:id', array(':id' => $_GET["id"]));
    echo '<script>alert("Admin Removed")</script>';
    echo '<script>window.location="view-admins.php"</script>';
  }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Hikingify | View Admins</title>
  <?php
  include('includes/links.php');
  ?>
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <!-- Navbar -->
    <?php include("includes/navbar.php") ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?php include("includes/aside.php") ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>View Admins</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">View Admins</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-10" style="margin: 0 auto;">
              <!-- general form elements disabled -->
              <!-- /.card-header -->
              <div class="card-body">
                <div class="card">
                  <div class="card-header border-transparent">
                    <h3 class="card-title">All Admins</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body p-0">
                    <div class="table-responsive">
                      <style>
                        td,
                        tr {
                          text-align: center;
                          align-items: center;
                        }
                      </style>
                      <table class="table m-0">
                        <thead>
                          <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          $user_info = DB::query('SELECT * FROM users WHERE type>1');
                          foreach ($user_info as $ui) {
                            if ($ui['id'] != $userid)
                            {

                            
                          ?>
                            <tr>
                              <td><?php echo $ui["id"]; ?></td>
                              <td><?php echo $ui["fullname"]; ?></td>
                              <td><?php echo $ui["email"]; ?></td>
                              <td>
                                <button class="btn  btn-outline-danger btn-sm" onClick="(function(){window.location='view-admins.php?action=delete&id=<?php echo $ui["id"]; ?>';return false;})();return false;"><i class="fas fa-trash"></i></button>
                                &nbsp;&nbsp;
                                <button class="btn btn-outline-success btn-sm" onClick="(function(){window.location='compose.php?to=<?php echo $ui['id']; ?>';return false;})();return false;"><i class="fas fa-comment"></i></button>
                                &nbsp;&nbsp;
                                <button class="btn btn-outline-primary btn-sm" onClick="(function(){window.location='edit-admin.php?ad=<?php echo $ui['id']; ?>';return false;})();return false;"><i class="fas fa-cog"></i></button>
                                &nbsp;&nbsp;
                                <button id="dect" class="btn btn-outline-danger btn-sm" onClick="(function(){window.location='view-admins.php?deactivate=<?php echo $ui['id']; ?>';return false;})();return false;">Give Penalty</button>
                              </td>
                            </tr>
                          <?php } }?>
                        </tbody>
                      </table>
                      <?php
                      if(!$user_info)
                      {
                          print '<h1 class="text-center m-3">Nothing to be shown</h1>';
                      }
                      ?>
                    </div>
                    <!-- /.table-responsive -->
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer clearfix">
                    <a href="register.php" class="btn btn-sm btn-secondary float-right">Add New Admin</a>
                  </div>
                  <!-- /.card-footer -->
                </div>
              </div>
            </div>
            <!--/.col (right) -->
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php include('includes/footer.php'); ?>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

  <script src="dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="dist/js/demo.js"></script>
  <!-- Page specific script -->
  <script>
    $(function() {
      bsCustomFileInput.init();
    });
  </script>
</body>

</html>