<?php

session_start();
error_reporting(0);
include('includes/dbconnection.php');
if(isset($_POST['submit']))
{


  $sid=$_SESSION['edid']; 
  $studentname=$_POST['studentname'];
  $regno=$_POST['regno'];
  $sex=$_POST['sex'];
  $age=$_POST['age'];
  $dept=$_POST['dept'];
  $class=$_POST['class'];
  $rank=$_POST['rank'];
  $regtno=$_POST['regtno'];
  $aadh=$_POST['aadh'];
  $bld=$_POST['bld'];
  $dob=$_POST['dob'];
  $year=$_POST['year'];

  $sql="update students set studentName=:studentname,studentno=:regno,gender=:sex,age=:age,class=:class,dept=:dept, rank=:rank, regtno=:regtno, aadh=:aadh, bld=:bld, dob=:dob , year=:year where id='$sid'";
  $query = $dbh->prepare($sql);
  $query->bindParam(':studentname',$studentname,PDO::PARAM_STR);
  $query->bindParam(':regno',$regno,PDO::PARAM_STR);
  $query->bindParam(':sex',$sex,PDO::PARAM_STR);
  $query->bindParam(':age',$age,PDO::PARAM_STR);
  $query->bindParam(':dept',$dept,PDO::PARAM_STR);
  $query->bindParam(':class',$class,PDO::PARAM_STR);
  $query->bindParam(':rank',$rank,PDO::PARAM_STR);
  $query->bindParam(':regtno',$regtno,PDO::PARAM_STR);
  $query->bindParam(':aadh',$aadh,PDO::PARAM_STR);
  $query->bindParam(':bld',$bld,PDO::PARAM_STR);
  $query->bindParam(':dob',$dob,PDO::PARAM_STR);
  $query->bindParam(':year',$year,PDO::PARAM_STR);
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
  $father=$_POST['father'];
  $mother=$_POST['mother'];
  $sql="update students set father=:father,mother=:mother where id='$sid'";
  $query = $dbh->prepare($sql);
  $query->bindParam(':father',$father,PDO::PARAM_STR);
  $query->bindParam(':mother',$mother,PDO::PARAM_STR);
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
  $phone=$_POST['phone'];
  $email=$_POST['email'];
  $address=$_POST['address'];
  $sql="update students set address=:address, phone=:phone, email=:email where id='$sid'";
  $query = $dbh->prepare($sql);
  $query->bindParam(':address',$address,PDO::PARAM_STR);
  $query->bindParam(':email',$email,PDO::PARAM_STR);
  $query->bindParam(':phone',$phone,PDO::PARAM_STR);
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

              <h3 class="profile-username text-center"><?php  echo $row['studentName'];?></h3>



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
                        <label for="companyname">Student's Name</label>
                     <input name="studentname" class="form-control" id="studentname"  value="<?php  echo $row['studentName'];?>" >
                       </div>
                       <!-- /.form-group -->
                     </div>
                     <div class="col-md-4">
                      <div class="form-group">
                      <label for="companyname">Registration No.</label>
                     <input name="regno" class="form-control" id="regno"  value="<?php  echo $row['studentno'];?>" >
                      </div>        
                    </div>
                    <!-- /.col -->
                  </div><!-- ./row -->
                  <div class="row">
                      <div class="col-md-8">
                        <div class="form-group">
                        <label for="companyname">Regimental No.</label>
                     <input name="regtno" class="form-control" id="regtno"  value="<?php  echo $row['regtno'];?>" >
                       </div>
                       <!-- /.form-group -->
                     </div>
                     <div class="col-md-4">
                      <div class="form-group">
                      <label for="companyname">Rank</label>
                     <input name="rank" class="form-control" id="rank"  value="<?php  echo $row['rank'];?>" >
                      </div>        
                    </div>
                    <!-- /.col -->
                  </div>

                  <div class="row">
                    <div class="col-md-2">
                      <div class="form-group">
                        <label for="companyname">Gender</label>
                     <input name="sex" class="form-control" value="<?php  echo $row['gender'];?>" >
                      </div>        
                    </div>
                    <div class="col-md-2">
                      <div class="form-group">
                      <label for="companyname">Age</label>
                     <input name="age" class="form-control" value="<?php  echo $row['age'];?>" >
                      </div>        
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                      <label for="companyname">Class</label>
                     <input name="class" class="form-control" value="<?php  echo $row['class'];?>" >
                      </div>        
                    </div>
                    <!-- /.col -->
                    <div class="col-md-4">
                      <div class="form-group">
                      <label for="companyname">Department</label>
                     <input name="dept" class="form-control" value="<?php  echo $row['dept'];?>" >
                      </div>        
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                      <label for="companyname">Aadhar No.</label>
                     <input name="aadh" class="form-control" id="aadh"  value="<?php  echo $row['aadh'];?>" >
                      </div>        
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                      <label for="companyname">Blood Group</label>
                     <input name="bld" class="form-control" id="bld"  value="<?php  echo $row['bld'];?>" >
                      </div>        
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                      <label for="companyname">Year of passing</label>
                     <input name="year" class="form-control" id="year"  value="<?php  echo $row['year'];?>" >
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
                     <label for="companyname">Father's Name</label>
                     <input name="father" class="form-control" id="father"  value="<?php  echo $row['father'];?>" required>
                   </div>
                   <!-- /.form-group -->
                   <div class="form-group col-md-6">
                     <label for="companyname">Mother's Name</label>
                     <input name="mother" class="form-control" id="mother"  value="<?php  echo $row['mother'];?>" required>
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
                    <input type="text" class="form-control" id="address" name="address" value="<?php  echo $row['address'];?>">
                  </div>
                </div>
                
              </div>

              <div class="row">
                <div class="form-group col-md-6">
                  <label for="inputEmail" class="col-sm-2 col-md-6 col-form-label">Email</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="email" id="email" value="<?php  echo $row['email'];?>">
                  </div>
                </div>
                <div class="form-group col-md-6">
                  <label for="inputName2" class="col-sm-2 col-md-6 col-form-label">Phone no.</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="phone" id="phone" value="<?php  echo $row['phone'];?>">
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