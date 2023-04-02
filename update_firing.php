<?php

session_start();
error_reporting(0);
include('includes/dbconnection.php');
if(isset($_POST['submit']))
{
  $sid=$_SESSION['edid']; 
  $f1=$_POST['f1'];
  $f2=$_POST['f2'];
  $f3=$_POST['f3'];
  $f4=$_POST['f4'];
  

  $sql = "update students set f1 = CASE WHEN :f1 <> '' THEN :f1 ELSE NULL END, f2 = CASE WHEN :f2 <> '' THEN :f2 ELSE NULL END, f3 = CASE WHEN :f3 <> '' THEN :f3 ELSE NULL END,f4 = CASE WHEN :f4 <> '' THEN :f4 ELSE NULL END where id='$sid'";
            

  $query = $dbh->prepare($sql);
  $query->bindParam(':f1',$f1,PDO::PARAM_STR);
  $query->bindParam(':f2',$f2,PDO::PARAM_STR);
  $query->bindParam(':f3',$f3,PDO::PARAM_STR);
  $query->bindParam(':f4',$f4,PDO::PARAM_STR);
  $query->execute();
  if ($query->execute()) {
    echo "<script>alert('updated successfull.');</script>";
    echo "<script>window.location.href ='firing_list.php'</script>";
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
                         <label for="Firing Trg 1">Firing Trg 1</label>
                         
                         <input type="date" id="f1" name="f1" class="form-control" value="<?php  echo $row['f1'];?>" >
                       </div>
                       <!-- /.form-group -->
                     </div>
                     <div class="col-md-8">
                      <div class="form-group">
                        <label for="Firing Trg 2">Firing Trg 2</label>
                        <input type="date" id="f2" name="f2" class="form-control" value="<?php  echo $row['f2'];?>" >
                      </div>        
                    </div>
                    <!-- /.col -->
                  </div><!-- ./row -->

                  <div class="row">
                    <div class="col-md-8">
                      <div class="form-group">
                        <label>Firing Trg 3</label>
                        <input type="date" id="f3" name="f3" class="form-control" value="<?php  echo $row['f3'];?>" >
                       
                        
                      </div>        
                    </div>
                    <div class="col-md-8">
                      <div class="form-group">
                        <label>Firing Trg 4</label>
                        <input type="date" id="f4" name="f4" class="form-control" value="<?php  echo $row['f4'];?>" >
                                               
                   
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