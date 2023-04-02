<?php

session_start();
error_reporting(0);
include('includes/dbconnection.php');
if(isset($_POST['submit']))
{
  $sid=$_SESSION['edid']; 
  $studentName=$_POST['studentName'];
  $age=$_POST['age'];
  $studentno=$_POST['studentno'];
  $sex=$_POST['sex'];
  $class=$_POST['class'];
  $stream=$_POST['stream'];
  $parentname=$_POST['parentname'];
  $relation=$_POST['relation'];
  $email=$_POST['email'];
  $nextphone=$_POST['nextphone'];
  $address=$_POST['address'];
  $photo=$_FILES["photo"]["name"];
  $regtno=$_POST["regtno"];
  $rank=$_POST["rank"];
  $aadh=$_POST["aadh"];
  $bld=$_POST["bld"];
  $dob=$_POST["dob"];


  $sql="update students set studentName=:studentName,studentno=:studentno,sex=:sex,age=:age,class=:class,stream=:stream,rank=:rank,regtno:=regtno, aadh:=aadh, bld:=bld, dob:=dob where id='$sid'";
  $query = $dbh->prepare($sql);
  $query->bindParam(':studentName',$studentName,PDO::PARAM_STR);
  $query->bindParam(':studentno',$studentno,PDO::PARAM_STR);
  $query->bindParam(':sex',$sex,PDO::PARAM_STR);
  $query->bindParam(':age',$age,PDO::PARAM_STR);
  $query->bindParam(':stream',$stream,PDO::PARAM_STR);
  $query->bindParam(':class',$class,PDO::PARAM_STR);
  $query->bindParam(':regtno',$regtno,PDO::PARAM_STR);
  $query->bindParam(':rank',$rank,PDO::PARAM_STR);
  $query->bindParam(':aadh',$aadh,PDO::PARAM_STR);
  $query->bindParam(':dob',$dob,PDO::PARAM_STR);
  $query->bindParam(':bld',$bld,PDO::PARAM_STR);
  $query->execute();
  if ($query->execute()) {
    echo "<script>alert('updated successfull.');</script>";
    echo "<script>window.location.href ='student_list.php'</script>";
  }else{
    echo "<script>alert('something went wrong, please try again later');</script>";
  }
}

if(isset($_POST['save']))
{
  $sid=$_SESSION['edid']; 
  $parentname=$_POST['parentname'];
  $relation=$_POST['relation'];
  $sql="update students set parentName=:parentname,relation=:relation where id='$sid'";
  $query = $dbh->prepare($sql);
  $query->bindParam(':parentname',$parentname,PDO::PARAM_STR);
  $query->execute();
  if ($query->execute()) {
    echo "<script>alert('updated successfull.');</script>";
    echo "<script>window.location.href ='student_list.php'</script>";
  }else{
    echo "<script>alert('something went wrong, please try again later');</script>";
  }
}

if(isset($_POST['pass']))
{
  $sid=$_SESSION['edid'];

  $village=$_POST['village'];
  $sql="update students set village=:village where id='$sid'";
  $query = $dbh->prepare($sql);
  $query->bindParam(':village',$village,PDO::PARAM_STR);
  $query->execute();
  if ($query->execute()) {
    echo "<script>alert('updated successfull.');</script>";
    echo "<script>window.location.href ='student_list.php'</script>";
  }else{
    echo "<script>alert('something went wrong, please try again later');</script>";
  }
}

if(isset($_POST['save2']))
{
  $sid=$_SESSION['edid'];
  $studentimage=$_FILES["studentimage"]["name"];
  move_uploaded_file($_FILES["studentimage"]["tmp_name"],"studentimages/".$_FILES["studentimage"]["name"]);
  $sql="update students set studentImage=:studentimage where id='$sid' ";
  $query = $dbh->prepare($sql);
  $query->bindParam(':studentimage',$studentimage,PDO::PARAM_STR);
  $query->execute();
  if ($query->execute()) {
    echo "<script>alert('updated successfull.');</script>";
    echo "<script>window.location.href ='student_list.php'</script>";
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
                <li class="nav-item"><a class="nav-link active" href="#companydetail" data-toggle="tab">Registration Detail</a></li>
                <li class="nav-item"><a class="nav-link" href="#companyaddress" data-toggle="tab">Parent Info</a></li>
                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Address</a></li>
                <li class="nav-item"><a class="nav-link" href="#change" data-toggle="tab">Update Image</a></li>
              </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
              <div class="tab-content">
                <div class="active tab-pane" id="companydetail">
                  <form role="form" id=""  method="post" enctype="multipart/form-data" class="form-horizontal" >
                    <div class="row">
                      <div class="col-md-8">
                        <div class="form-group">
                         <label for="companyname">Student Name</label>
                         <input name="studentName" class="form-control" name="studentName" id="studentName" value="<?php  echo $row['studentName'];?>" required>
                       </div>
                       <!-- /.form-group -->
                     </div>
                     <div class="col-md-4">
                      <div class="form-group">
                        <label for="studentno">Registration No.</label>
                        <input name="studentno" class="form-control" name="studentno" id="studentno" value="<?php  echo $row['studentno'];?>" required>
                      </div>        
                    </div>
                    <!-- /.col -->
                  </div><!-- ./row -->
                  <div class="row">
                      <div class="col-md-8">
                        <div class="form-group">
                         <label for="companyname">Regimental No.</label>
                         <input name="regtno" class="form-control" name="regtno" id="regtno" value="<?php  echo $row['regtno'];?>" required>
                       </div>
                       <!-- /.form-group -->
                     </div>
                     <div class="col-md-4">
                      <div class="form-group">
                        <label for="rank">Rank</label>
                        <input name="rank" class="form-control" name="rank" id="rank" value="<?php  echo $row['rank'];?>" required>
                      </div>        
                    </div>
                    <!-- /.col -->
                  </div>

                  <div class="row">
                    <div class="col-md-2">
                      <div class="form-group">
                        <label>Sex</label>
                        <input class="form-control" name="sex" id="sex" value="<?php  echo $row['sex'];?>" required>
                      </div>        
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                        <label>Age</label>
                        <input class="form-control" name="age" id="age" value="<?php  echo $row['age'];?>" required>
                      </div>        
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Class</label>
                        <input class="form-control" name="class" id="class" value="<?php  echo $row['class'];?>" required>
                      </div>        
                    </div>
                    <!-- /.col -->
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Department</label>
                        <input class="form-control" name="stream" id="stream" value="<?php  echo $row['stream'];?>" required>
                      </div>        
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Aadhar No.</label>
                        <input class="form-control" name="aadh" id="aadh" value="<?php  echo $row['aadh'];?>" required>
                      </div>        
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label>Blood Group</label>
                        <input class="form-control" name="bld" id="bld" value="<?php  echo $row['bld'];?>" required>
                      </div>        
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="DOB">Date of Birth</label>
                        <input type="date" id="dob" name="dob" class="form-control" value="<?php  echo $row['dob'];?>" >
                      </div>        
                    </div>
                    <!-- /.col --> 
                  </div>
                  <!-- /.card-body -->
                  <div class="modal-footer text-right">
                    <button type="submit" name="submit" class="btn btn-primary">Update</button>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
              <div class=" tab-pane" id="companyaddress">
                <form role="form" id=""  method="post" enctype="multipart/form-data" class="form-horizontal" >

                  <div class="row">
                    <div class="form-group col-md-6">
                     <label for="companyname">Father 's Name</label>
                     <input name="parentname" class="form-control" id="parentname"  value="<?php  echo $row['parentName'];?>" required>
                   </div>
                   <!-- /.form-group -->
                   <div class="form-group col-md-6">
                     <label for="companyname">Mother 's Name</label>
                     <input name="relation" class="form-control" id="relation"  value="<?php  echo $row['relation'];?>" required>
                   </div>
                   <!-- /.form-group -->

                  <!-- /.col -->
                </div><!-- ./row -->

                <div class="row">
                  
                  <!-- /.col -->
                  
                  <!-- /.col --> 
                </div>

                <!-- /.card-body -->
                <div class="modal-footer text-right">
                  <button type="submit" name="save" class="btn btn-primary">Update</button>
                </div>

              </form>
            </div>

            <!-- /.tab-pane -->

            <div class=" tab-pane" id="change">
             <div class="row">
              <form role="form" id=""  method="post" enctype="multipart/form-data" class="form-horizontal" >
                <div class="form-group">
                  <label>Upload Image</label>
                  <input type="file" class="" name="studentimage" value="" required>
                </div>  

                <div class="modal-footer text-right">
                  <button type="submit" name="save2" class="btn btn-primary">Update</button>
                </div>

              </form>
            </div>
          </div>



          <div class="tab-pane" id="settings">
            <form role="form" id=""  method="post" enctype="multipart/form-data" >
              <div class="row">
                <div class="form-group col-md-6">
                  <label for="inputName" class="col-sm-2 col-md-6 col-form-label">Address</Address></label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="country" name="country" value="<?php  echo $row['village'];?>">
                  </div>
                </div>
                
              </div>

              <div class="row">
                <div class="form-group col-md-6">
                  <label for="inputEmail" class="col-sm-2 col-md-6 col-form-label">Email</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="state" id="state" value="<?php  echo $row['email'];?>">
                  </div>
                </div>
                <div class="form-group col-md-6">
                  <label for="inputName2" class="col-sm-2 col-md-6 col-form-label">Phone no.</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="village" id="village" value="<?php  echo $row['nextphone'];?>">
                  </div>
                </div>
              </div>
              <div class="form-group row">
                <div class="offset-sm-2 col-sm-10">
                  <button type="submit" name="pass" class="btn btn-success">Submit</button>
                </div>
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