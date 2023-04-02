<?php

session_start();
error_reporting(0);
include('includes/dbconnection.php');
if(isset($_POST['submit']))
{
  $sid=$_SESSION['edid']; 
  $c1=$_POST['c1'];
  $c2=$_POST['c2'];
  $c3=$_POST['c3'];
  $c4=$_POST['c4'];
  $c5=$_POST['c5'];
  

  $sql = "update students set c1 = CASE WHEN :c1 <> '' THEN :c1 ELSE NULL END, c2 = CASE WHEN :c2 <> '' THEN :c2 ELSE NULL END, c3 = CASE WHEN :c3 <> '' THEN :c3 ELSE NULL END,c4 = CASE WHEN :c4 <> '' THEN :c4 ELSE NULL END, c5 = CASE WHEN :c5 <> '' THEN :c5 ELSE NULL END where id='$sid'";
         

  $query = $dbh->prepare($sql);
  $query->bindParam(':c1',$c1,PDO::PARAM_STR);
  $query->bindParam(':c2',$c2,PDO::PARAM_STR);
  $query->bindParam(':c3',$c3,PDO::PARAM_STR);
  $query->bindParam(':c4',$c4,PDO::PARAM_STR);
  $query->bindParam(':c5',$c5,PDO::PARAM_STR);
  $query->execute();
  if ($query->execute()) {
    echo "<script>alert('updated successfull.');</script>";
    echo "<script>window.location.href ='camp_info.php'</script>";
  }else{
    echo "<script>alert('something went wrong, please try again later');</script>";
  }
}

?>


<!-- Content Wrapper. Contains page content -->
<div class="card-body">
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
       <?php
       $eid=$_POST['edit_id'];
       $ret=mysqli_query($con,"select * from  students where id='$eid'");
       $cnt=1;
       while ($row=mysqli_fetch_array($ret))
       {
         $_SESSION['edid']=$row['id']; 
         ?>
         <div class="col-md-3">
           <!-- Profile Image -->
           <div class="card card-primary card-outline">
            <div class="card-body box-profile">
              <div class="text-center">
                <img class="img-circle"
                src="studentimages/<?php echo htmlentities($row['studentImage']);?>" width="150" height="150" class="user-image"
                alt="User profile picture">
              </div>

              <h3 class="profile-username text-center"><?php  echo $row['name'];?></h3>



              <p class="text-muted text-center"><strong></strong></p>

              <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                  <b>Email</b> <a class="float-right"><?php  echo $row['email'];?></a>
                </li>
                <li class="list-group-item">
                  <b>Contact No</b> <a class="float-right">0<?php  echo $row['contactno'];?> </a>
                </li>
                
              </ul>

            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="card">
            <div class="card-header p-2">
              <ul class="nav nav-pills">
                <li class="nav-item"><a class="nav-link active" href="#companydetail" data-toggle="tab">Firing Detail</a></li>
                
              </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
              <div class="tab-content">
                <div class="active tab-pane" id="companydetail">
                  <form role="form" id=""  method="post" enctype="multipart/form-data" class="form-horizontal" >
                    <div class="row">
                      <div class="col-md-8">
                        <div class="form-group">
                         <label for="Camp 1">Camp 1</label>
                         <input name="c1" class="form-control" name="c1" id="c1" value="<?php  echo $row['c1'];?>" >
                         
                       </div>
                       <!-- /.form-group -->
                     </div>
                     <div class="col-md-8">
                      <div class="form-group">
                        <label for="Camp 2">Camp 2</label>
                        <input name="c2" class="form-control" name="c2" id="c2" value="<?php  echo $row['c2'];?>" >
                      </div>        
                    </div>
                    <!-- /.col -->
                  </div><!-- ./row -->

                  <div class="row">
                    <div class="col-md-8">
                      <div class="form-group">
                        <label>Camp 3</label>
                        <input name="c3" class="form-control" name="c3" id="c3" value="<?php  echo $row['c3'];?>" >
                       
                        
                      </div>        
                    </div>
                    <div class="col-md-8">
                      <div class="form-group">
                        <label>Camp 4</label>
                        <input name="c4" class="form-control" name="c4" id="c4" value="<?php  echo $row['c4'];?>" >
                                               
                   
                  </div>

                  <div class="form-group">
                  <label>Camp 5</label>
                  <input name="c5" class="form-control" name="c5" id="c5" value="<?php  echo $row['c5'];?>" >
</div>

                  <!-- /.card-body -->
                  <div class="modal-footer text-right">
                    <button type="submit" name="submit" class="btn btn-primary">Update</button>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
         
          <?php  
        }?>
      </div>
      <!-- /.tab-content -->
    </div><!-- /.card-body -->
  </section>
  <!-- /.content -->
</div>
  <!-- /.content-wrapper -->