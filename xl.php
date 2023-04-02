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
              <h1>Combined Information Record</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item active">Records & Export</li>
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
                <form method="POST" action="">
  <label for="year">Year of Passing Out:</label>
  <input type="text" name="year" id="year" required>
  <input type="submit" name="search" value="Search">
</form>
                  <div class="card-tools">
                    <a href="add_student.php"><button type="button" class="btn btn-sm btn-primary"  ><span style="color: #fff;"><i class="fas fa-plus" ></i>  New Students</span>
                    </button> </a>                  
                  </div>
                </div>
                
                <!-- /.card-header -->
                <div id="editData" class="modal fade">
                  <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Cadet details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body" id="info_update">
                        <?php @include("edit_student.php");?>
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
               
                <div id="editData2" class="modal fade">
                  <div class="modal-dialog ">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Cadet Details</h5>
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
                        <th>S/No</th>
                        <th>Cadet Image</th>
                        <th>Rank</th>
                        <th>Cadet Name</th>
                        <th>Regimental Number</th>
                        <th>Register Number</th>
                        <th>Class</th>
                        <th>Department</th>
                        <th>Contact No.</th>
                        <th>Aadhar No.</th>
                        <th>Father's Name</th>
                        <th>Mother's Name</th>
                        <th>Gender</th>
                        <th>DOB</th>
                        <th>Residential Address</th>
                        <th>Email</th>
                        <th>Blood Group</th>
                        <th>Sortie 1</th>
                        <th>Sortie 2</th>
                        <th>Sortie 3</th>
                        <th>Sortie 4</th>
                        <th>Camp 1</th>
                        <th>Camp 2</th>
                        <th>Camp 3</th>
                        <th>Camp 4</th>
                        <th>Camp 5</th>
                        <th>Firing 1</th>
                        <th>Firing 2</th>
                        <th>Firing 3</th>
                        <th>Firing 4</th>

                        <th>Action</th>
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
                        <tr>
                          <td><?php echo htmlentities($cnt);?></td>
                          <td class="align-middle"><a href="#"><img src="studentimages/<?php echo htmlentities($row['studentImage']);?>" width="40" height="40"> </a></td>
                          
                          <td><?php echo htmlentities($row['rank']);?></td>
                          <td><?php echo htmlentities($row['studentName']);?></td>
                          <td><?php echo htmlentities($row['regtno']);?></td>
                          <td><?php echo htmlentities($row['studentno']);?></td>
                          <td><?php echo htmlentities($row['class']);?></td>
                          <td><?php echo htmlentities($row['dept']);?></td>
                          <td><?php echo htmlentities($row['phone']);?></td>
                          <td><?php echo htmlentities($row['aadh']);?></td>
                          <td><?php echo htmlentities($row['father']);?></td>
                          <td><?php echo htmlentities($row['mother']);?></td>
                          <td><?php echo htmlentities($row['gender']);?></td>
                          <td><?php echo htmlentities($row['dob']);?></td>
                          <td><?php echo htmlentities($row['address']);?></td>
                          <td><?php echo htmlentities($row['email']);?></td>
                          <td><?php echo htmlentities($row['bld']);?></td>
                          <td><?php echo htmlentities($row['s1']);?></td>
                          <td><?php echo htmlentities($row['s2']);?></td>
                          <td><?php echo htmlentities($row['s3']);?></td>
                          <td><?php echo htmlentities($row['s4']);?></td>
                          <td><?php echo htmlentities($row['c1']);?></td>
                          <td><?php echo htmlentities($row['c2']);?></td>
                          <td><?php echo htmlentities($row['c3']);?></td>
                          <td><?php echo htmlentities($row['c4']);?></td>
                          <td><?php echo htmlentities($row['c5']);?></td>
                          <td><?php echo htmlentities($row['f1']);?></td>
                          <td><?php echo htmlentities($row['f2']);?></td>
                          <td><?php echo htmlentities($row['f3']);?></td>
                          <td><?php echo htmlentities($row['f4']);?></td>


                          <td>
                            <button  class=" btn btn-primary btn-xs edit_data" id="<?php echo  $row['id']; ?>" title="click for edit"> Update </i></button>
                            
                            <a href="student_list.php?id=<?php echo $row['id']?>&del=delete" onClick="return confirm('Are you sure you want to delete?')" class=" btn btn-danger btn-xs ">Delete</a>

                          </td>
                        </tr>
                        
                        <?php $cnt=$cnt+1;
                      } ?>
                    </tbody>
                  </table>
                </div>
                <!-- /.card-body -->

                <style>
  .big-button {
    font-size: 20px;
    padding: 2px 20px;
  }
</style>

<button class="big-button" onclick="location.href='export.php'">Export as Excel Sheet</button>

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
          url:"edit_student.php",
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