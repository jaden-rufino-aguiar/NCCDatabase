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
<script type="text/javascript">
	function getatt(value)
	{
		if(value == true)
		{
			document.getElementById("txtAbsent").value = parseInt(document.getElementById("txtAbsent").value) - 1;
			document.getElementById("txtPresent").value = parseInt(document.getElementById("txtPresent").value) + 1;
		}
		else
		{
			document.getElementById("txtAbsent").value = parseInt(document.getElementById("txtAbsent").value) + 1;
			document.getElementById("txtPresent").value = parseInt(document.getElementById("txtPresent").value) - 1;
		}
	}
</script>
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
              <h1>Parade Attendance Management</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                <li class="breadcrumb-item active">Mark Parade Attendance</li>
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
                <div class="center-align">
                <button class="big-button" onclick="location.href='view_att.php'" style="">View Attendance</button>   
</div>
                  <div class="card-tools">
                  <form action="update_att.php" method="post">
                  <table width="180px" align="left" style="margin-top: 50px; margin-left: 550px;">

            	      <tr>
                	      <td> Select Parade  date : <br />
                          <?php 
				 		                $dt = getdate();
							              $day = $dt["mday"];
							              $month = date("m");
							              $year = $dt["year"];
							              echo "<select name='cdate'>";
							              for($a=1;$a<=31;$a++)
							            {
								              if($day == $a)
									                echo "<option value='$a' selected='selected'>$a</option>";
								              else
									                echo "<option value='$a' >$a</option>";
							            }
							            echo "</select><select name='cmonth'>";
							            for($a=1;$a<=12;$a++)
							            {
								            if($month == $a)
								            	echo "<option value='$a' selected='selected'>$a</option>";
								            else
								              echo "<option value='$a' >$a</option>";
							            }
							            echo "</select><select name='cyear'>";
                          for($a=2010;$a<=$year;$a++)
                          {
                            if($year == $a)
                              echo "<option value='$a' selected='selected'>$a</option>";
                            else
                              echo "<option value='$a' >$a</option>";
                          }
                          echo "</select>";
						              ?>                    
                    </td>
                </tr>
             </table>
             
             
             
             <table width="1175" border="2" align="center"  style="margin-left:20px;margin-right:20px; margin-bottom: 20px;">
            <tr>
              <td width="114">Regimental Number</td>
              <td width="152">Name</td>
              <td width="110">Absent</td>
            </tr>
            <?php

				include "access.php";
				extract($_POST);
				$query = "select *from `students` order by `id`";
				$s = 0;
				$result = mysqli_query($con,$query)or die("select error");
				while($rec = mysqli_fetch_array($result))
				{
					$s = $s + 1;
					echo ' <tr>
							  <td width="114">'.$rec["regtno"].'</td>
							  <td width="152">'.$rec["studentName"].'</td>
							  <td width="110"><input type=checkbox name='.$rec["id"].' onclick="getatt(this.checked);"/></td>
							</tr>';
				}
			?>	
      <table width="100px" align="right" style="margin-right: 50px; margin-bottom: 15px;">
            	<tr>
                	<td> Total Present : <input type="text" id="txtAbsent" value="<?php print $s; ?>" size="10" disabled="disabled"/></td>
                </tr>
                <tr>
                	<td> Total Absent : <input type="text" id="txtPresent" value="0" size="10"  disabled="disabled"/></td>
                </tr>
                <tr>
                	<td> Total Strength : <input type="text" id="txtStrength" value="<?php print $s; ?>" size="10" disabled="disabled"/></td>
                </tr>
             </table>		
            <tr>
              <td colspan="3"><div align="center">
                <input type="submit" value="Update Attendance" name="btnsubmit" style="margin-left: 175px"/>
                &nbsp;&nbsp;</div></td>
            </tr>
          </table>
          </form>
          
                            
                </div>

               
                <div id="editData2" class="modal fade">
                  <div class="modal-dialog ">
                    <div class="modal-content">
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
                  <!-- /.modal -->
                </div>
                <!--   end modal -->

                <div class="card-body mt-2 " >
                    <style>
  .big-button {
    font-size: 20px;
    padding: 2px 20px;
  }
  .center-align {
      text-align: center;
    }
</style>

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
          url:"camper.php",
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
