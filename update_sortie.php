<?php

session_start();
error_reporting(0);
include('includes/dbconnection.php');
if(isset($_POST['submit']))
{
  $sid=$_SESSION['edid']; 
  $s1=$_POST['s1'];
  $s2=$_POST['s2'];
  $s3=$_POST['s3'];
  $s4=$_POST['s4'];
  $sql = "update students set s1 = CASE WHEN :s1 <> '' THEN :s1 ELSE NULL END, s2 = CASE WHEN :s2 <> '' THEN :s2 ELSE NULL END, s3 = CASE WHEN :s3 <> '' THEN :s3 ELSE NULL END,s4 = CASE WHEN :s4 <> '' THEN :s4 ELSE NULL END where id='$sid'";

  $query = $dbh->prepare($sql);
  $query->bindParam(':s1',$s1,PDO::PARAM_STR);
  $query->bindParam(':s2',$s2,PDO::PARAM_STR);
  $query->bindParam(':s3',$s3,PDO::PARAM_STR);
  $query->bindParam(':s4',$s4,PDO::PARAM_STR);
  $query->execute();
  if ($query->execute()) {
    echo "<script>alert('updated successfull.');</script>";
    echo "<script>window.location.href ='sortie_info.php'</script>";
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
                  <b>Name</b> <a class="float-right"><?php  echo $row['studentName'];?></a>
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
                <li class="nav-item"><a class="nav-link active" href="#companydetail" data-toggle="tab">Sortie Detail</a></li>
                
              </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
              <div class="tab-content">
                <div class="active tab-pane" id="companydetail">
                  <form role="form" id=""  method="post" enctype="multipart/form-data" class="form-horizontal" >
                    <div class="row">
                      <div class="col-md-8">
                        <div class="form-group">
                         <label for="1st Sortie">1st Sortie</label>
                         
                         <input type="date" id="s1" name="s1" class="form-control" value="<?php  echo $row['s1'];?>" >
                       </div>
                       <!-- /.form-group -->
                     </div>
                     <div class="col-md-8">
                      <div class="form-group">
                        <label for="2nd Sortie">2nd Sortie</label>
                        <input type="date" id="s2" name="s2" class="form-control" value="<?php  echo $row['s2'];?>" >
                      </div>        
                    </div>
                    <!-- /.col -->
                  </div><!-- ./row -->

                  <div class="row">
                    <div class="col-md-8">
                      <div class="form-group">
                      <label for="3rd Sortie">3rd Sortie</label>
                        <input type="date" id="s3" name="s3" class="form-control" value="<?php  echo $row['s3'];?>" >
                       
                        
                      </div>        
                    </div>
                    <div class="col-md-8">
                      <div class="form-group">
                      <label for="4th Sortie">4th Sortie</label>
                        <input type="date" id="s4" name="s4" class="form-control" value="<?php  echo $row['s4'];?>" >
                                               
                   
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