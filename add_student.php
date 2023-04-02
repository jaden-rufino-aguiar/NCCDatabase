<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['sid']==0)) {
  header('location:logout.php');
} else{
  if(isset($_POST['submit']))
  {
    $names=$_POST['names'];
    $age=$_POST['age'];
    $studentno=$_POST['studentno'];
    $sex=$_POST['sex'];
    $class=$_POST['class'];
    $dept=$_POST['dept'];
    $father=$_POST['father'];
    $mother=$_POST['mother'];
    $email=$_POST['email'];
    $phone=$_POST['phone'];
    $address=$_POST['address'];
    $photo=$_FILES["photo"]["name"];
    $regtno=$_POST["regtno"];
    $rank=$_POST["rank"];
    $aadh=$_POST["aadh"];
    $bld=$_POST["bld"];
    $dob=$_POST["dob"];
    $year=$_POST["year"];



    move_uploaded_file($_FILES["photo"]["tmp_name"],"studentimages/".$_FILES["photo"]["name"]);
    $query=mysqli_query($con, "insert into  students(studentno,StudentName,rank,regtno,class,dept,aadh,age,gender,email,father,mother,address,phone,bld,dob,studentImage,year) value('$studentno','$names','$rank','$regtno','$class','$dept','$aadh','$age','$sex','$email','$father','$mother','$address','$phone','$bld','$dob','$photo','$year')");
    if ($query) {
      echo "<script>alert('Student has been registered.');</script>"; 
      echo "<script>window.location.href = 'add_student.php'</script>";   
      $msg="";
    }
    else
    {
      echo "<script>alert('Something Went Wrong. Please try again.');</script>";    
    }
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
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">Add Cadet Details</li>
                </ol>
              </div>
            </div>
          </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="container-fluid">
            <div class="row ">
              <div class="col-md-12">
                <!-- general form elements -->
                <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">Add Cadet Details</h3>
                  </div>
                  <!-- /.card-header -->
                  <!-- form start -->
                  <form role="form" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                      <span style="color: brown"><h5>Cadet Personal Details</h5></span>
                      <hr>
                      <div class="row">
                        <div class="form-group col-md-3">
                          <label for="studentno">Register No.</label>
                          <input type="text" class="form-control" id="studentno" name="studentno" placeholder="Enter register No" required>
                        </div>
                        <div class="form-group col-md-3">
                          <label for="regtno">Regimental no.</label>
                          <input type="text" class="form-control" id="regtno" name="regtno" placeholder="Enter regimental No" required>
                        </div>
                        <div class="form-group col-md-3">
                          <label for="regtno">Rank</label>
                          <input type="text" class="form-control" id="rank" name="rank" placeholder="Enter rank " required>
                        </div>
                        <div class="form-group col-md-5">
                          <label for="names">Names</label>
                          <input type="text" class="form-control" id="names" name="names" placeholder="Names" required>
                        </div>
                        <div class="form-group col-md-2">
                          <label for="age">Age</label>
                          <input type="text" class="form-control" id="age" name="age" placeholder="age"required>
                        </div>
                        <div class="form-group col-md-2">
                          <label for="sex">Sex</label>
                          <select type="select" class="form-control" id="sex" name="sex"required>
                            <option>Select Sex</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                          </select>
                        </div>
                      </div>
                      <div class="row">
                        <div class="form-group col-md-4">
                          <label for="age">Class</label>
                          <input type="text" class="form-control" id="names" name="class" placeholder="Class" required>
                        </div>
                        <div class="form-group col-md-4">
                          <label for="age">Department</label>
                          <select type="select" class="form-control" id="dept" name="dept">
                            <option>Select dept</option>
                            <option value="CSE">CSE</option>
                            <option value="IT">IT</option>
                            <option value="MECH">MECH</option>
                            <option value="PSYCH">PSYCH</option>
                            <option value="ECE">ECE</option>
                            <option value="BBA">BBA</option>
                            <option value="AE">AE</option>
                            <option value="EEE">EEE</option>
                            <option value="CIVIL">CIVIL</option>
                            
                          </select>
                        </div>
                        
                        <div class="form-group col-md-3">
                          <label for="aadh">Aadhar No.</label>
                          <input type="text" class="form-control" id="aadh" name="aadh" placeholder="Enter Aadhar No." required>
                        </div>
                        <div class="form-group col-md-4">
                          <label for="age">Blood</label>
                          <input type="text" class="form-control" id="bld" name="bld" placeholder="Enter Blood group" required>
                        </div>
                        <div class="form-group mb-3">
                                <label for="">Date of Birth</label>
                                <input type="date" id="dob" name="dob" class="form-control" />
                            </div>
                            <div class="form-group col-md-3">
                          <label for="aadh">Year of passing</label>
                          <input type="year" class="form-control" id="year" name="year" placeholder="Enter year of passing" required>
                        </div>
                        <div class="form-group col-md-4">
                          <label for="exampleInputFile">Student Photo</label>
                          <div class="input-group">
                            <div class="custom-file">
                              <input type="file" class="" name="photo" id="photo" >
                            </div>
                          </div>
                        </div>
                      </div>
                      <hr>
                      <span style="color: brown"><h5>Parent details</h5></span>
                      <div class="row">
                        <div class="form-group col-md-3">
                          <label for="father">Father's Name</label>
                          <input type="text" class="form-control" id="father" name="father" placeholder="Enter Father's Name" required>
                        </div>
                        <div class="form-group col-md-5">
                          <label for="mother">Mother's Name</label>
                          <input type="text" class="form-control" id="mother" name="mother" placeholder="Enter Mother's Name" required>
                        </div>
                      </div>
                      <div class="row">
                        
                      </div>
                      <hr>
                      <span style="color: brown"><h5>Contact Information</h5></span>
                      <div class="row">
                        <div class="form-group col-md-3 ">
                          <label for="address">Address</label>
                          <input type="text" class="form-control" id="address" name="address" placeholder="Enter address"required>
                        </div>
                        <div class="form-group col-md-3">
                          <label for="phone">Phone</label>
                          <input type="text" class="form-control" id="phone" name="phone" placeholder="Enter Phone No." required>
                        </div>
                        <div class="form-group col-md-2">
                          <label for="age">Email</label>
                          <input type="text" class="form-control" id="email" name="email" placeholder="email" required>
                        </div>
                      </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                      <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </div>
                  </form>
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

    </div>

    <!-- ./wrapper -->
    <?php @include("includes/foot.php"); ?>
  </body>
  </html>
  <?php
}?>