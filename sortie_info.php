<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['sid']==0)) {
 header('location:logout.php');
} 
if(isset($_GET['del']))
{
  mysqli_query($con,"delete from students where id = '".$_GET['id']."'");
  $_SESSION['delmsg']="student deleted !!";
}
?>
<!DOCTYPE html>
<html>
<?php @include("includes/head.php"); ?>
<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <!-- Navbar -->
    <?php @include("includes/header.php"); ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?php @include("includes/sidebar.php"); ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Sortie Information</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item active">Sortie Information</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">

                  <div class="card-tools">
                    
                </div>
                <!-- /.card-header -->
                <div id="editData" class="modal fade">
                  <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Student details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body" id="info_update">
                        <?php @include("update_sortie.php");?>
                      </div>
                      <div class="modal-footer ">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                  <!-- /.modal -->
                </div>
                <form method="POST" action="">
  <label for="year">Year of Passing Out:</label>
  <input type="text" name="year" id="year" required>
  <input type="submit" name="search" value="Search">
</form>
                <!--   end modal -->
               
                <div id="editData2" class="modal fade">
                  <div class="modal-dialog ">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Student Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body" id="info_update2">
                        <?php @include("view_student_info.php");?>
                      </div>
                      <div class="modal-footer ">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                  <!-- /.modal -->
                </div>
                <!--   end modal -->

                <div class="card-body mt-2 " >
                  <table id="example1" class="table table-bordered table-hover">
                    <thead> 
                      <tr> 
                        <th>#</th>
                       
                        <th>Rank</th>
                        <th>Student Name</th>
                        <th>Regimental Number</th>
                        
                        
                        <th>1st Sortie </th>
                        <th>2nd Sortie </th>
                        <th>3rd Sortie </th>
                        <th>4th Sortie </th>
                        <th>Total Sorties </th>
                        <th>Modify </th>
                      </tr> 
                    </thead> 
                    <tbody>
                    <?php    
                    if (isset($_POST['search'])) {
  $year = $_POST['year'];
  $query = mysqli_query($con, "SELECT * FROM students WHERE year = '$year'");
} else {
  $query = mysqli_query($con, "SELECT * FROM students");
}
                      $cnt=1;
                      while($row=mysqli_fetch_array($query))
                      {
                        ?>   
                        <?php
                        $tally = 0;
  if (!empty($row['s1'])) {
    $tally++;
  }
  if (!empty($row['s2'])) {
    $tally++;
  }
  if (!empty($row['s3'])) {
    $tally++;
  }
  if (!empty($row['s4'])) {
    $tally++;
  }

?>               
                        <tr>
                          <td><?php echo htmlentities($cnt);?></td>
                          <td><?php echo htmlentities($row['rank']);?></td>
                          <td><?php echo htmlentities($row['studentName']);?></td>
                          <td><?php echo htmlentities($row['regtno']);?></td>
                          <td><?php echo htmlentities($row['s1']);?></td>
                          <td><?php echo htmlentities($row['s2']);?></td>
                          <td><?php echo htmlentities($row['s3']);?></td>
                          <td><?php echo htmlentities($row['s4']);?></td>
                          <td><?php echo $tally;?></td>
                          
                          <td>
                            <button  class=" btn btn-primary btn-xs edit_data" id="<?php echo  $row['id']; ?>" title="click for edit">Edit</i></button>
                            

                          </td>
                          
                        </tr>
                        
                        <?php $cnt=$cnt+1;
                        
                      } ?>
                    
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <?php @include("includes/footer.php"); ?>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>

  <!-- ./wrapper -->
  <?php @include("includes/foot.php"); ?>
  <script type="text/javascript">
    $(document).ready(function(){
      $(document).on('click','.edit_data',function(){
        var edit_id=$(this).attr('id');
        $.ajax({
          url:"update_sortie.php",
          type:"post",
          data:{edit_id:edit_id},
          success:function(data){
            $("#info_update").html(data);
            $("#editData").modal('show');
          }
        });
      });
    });
  </script>
  <script type="text/javascript">
    $(document).ready(function(){
      $(document).on('click','.edit_data2',function(){
        var edit_id2=$(this).attr('id');
        $.ajax({
          url:"view_student_info.php",
          type:"post",
          data:{edit_id2:edit_id2},
          success:function(data){
            $("#info_update2").html(data);
            $("#editData2").modal('show');
          }
        });
      });
    });
  </script>
</body>
</html>
