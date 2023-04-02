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
              <h1>View Attendance</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item active">View Attendance</li>
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


                <!-- /.card-header -->
                <tr>
        <td><div align="center">
        <form action="" method="post">
          <?php
		if(isset($_POST["btnsubmit"]))
		{
			include "access.php";
			extract($_POST);
			$query = "select * from `students` where regtno = ".$eno." limit 1";

			$result = mysqli_query($con,$query)or die("select error error");
			while($rec = mysqli_fetch_array($result))
			{
				echo '<tr><td colspan="2"><table width="400" border="2" align="center" >
				<tr>
				  <td width="160"> Regimental No</td>
				  <td width="160"> Name</td>';
				  $query1 = "select * from `attendance` where `member_id` = ".$rec["id"]." ORDER BY date";
					$result1 = mysqli_query($con,$query1)or die("select error error");
					while($rec1 = mysqli_fetch_array($result1))
					{
				  		echo '<td >'.$rec1["date"].'</td>';
					}
				echo '</tr>
				<tr>
				  <td width="222"><span class="style6">'.$rec["regtno"].'</span></td>
				  <td width="222"><span class="style6">'.$rec["studentName"].'</span></td>';
				  $query1 = "select *from `attendance` where `member_id` = ".$rec["id"]." ORDER BY date";
					$result1 = mysqli_query($con,$query1)or die("select error error");
					while($rec1 = mysqli_fetch_array($result1))
					{
				  		echo '<td>';
						if($rec1["attendance"]==0)
							echo "Absent";
						else
							echo "Present";
						echo '</td>';
					}
				
				echo '
				</tr>
								
			  </table></td></tr>';
			}
		}
		else
		include "access.php";
extract($_POST);
$query = "SELECT * FROM `students`";

$result = mysqli_query($con, $query) or die("select error error");

// Print the table header with dates as headings
echo '<table width="90%" border="2">
    <tr>
        <th width="160"> Regimental No</th>
        <th width="160">Name</th>';
        
$query1 = "SELECT DISTINCT `date` FROM `attendance` ORDER BY `date`";
$result1 = mysqli_query($con, $query1) or die("select error error");

while($rec1 = mysqli_fetch_array($result1)) {
    echo '<th>'.$rec1["date"].'</th>';
}

echo '</tr>';

// Print one row per student
while($rec = mysqli_fetch_array($result)) {
    echo '<tr>
        <td>'.$rec["regtno"].'</td>
        <td>'.$rec["studentName"].'</td>';
        
    $query1 = "SELECT `attendance` FROM `attendance` WHERE `member_id` = ".$rec["id"]." ORDER BY `date`";
    $result1 = mysqli_query($con, $query1) or die("select error error");
    
    while($rec1 = mysqli_fetch_array($result1)) {
        echo '<td>';
        if($rec1["attendance"] == 0)
            echo "Absent";
        else
            echo "Present";
        echo '</td>';
    }
    
    echo '</tr>';
}

echo '</table>';

		?>  
               
                <div id="editData2" class="modal fade">
                  <div class="modal-dialog ">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Student Details</h5>
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

                    <tbody>
                     
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
          url:"update_firing.php",
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