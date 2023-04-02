<?php

session_start();
error_reporting(0);
include('includes/dbconnection.php');
if(isset($_POST['submit']))
{
  $sid=$_SESSION['edid']; 
  $f1=$_POST['c1'];
  $f2=$_POST['c2'];
  $f3=$_POST['c3'];
  $f4=$_POST['c4'];
  $f4=$_POST['c4'];
  $f4=$_POST['c5'];
  $sql = "update students set c1 = CASE WHEN :c1 <> '' THEN :c1 ELSE NULL END, c2 = CASE WHEN :c2 <> '' THEN :c2 ELSE NULL END, c3 = CASE WHEN :c3 <> '' THEN :c3 ELSE NULL END,c4 = CASE WHEN :c4 <> '' THEN :c5 ELSE NULL END, c5 = CASE WHEN :c5 <> '' THEN :c5 ELSE NULL END where id='$sid'";

  $query = $dbh->prepare($sql);
  $query->bindParam(':c1',$c1,PDO::PARAM_STR);
  $query->bindParam(':c2',$c2,PDO::PARAM_STR);
  $query->bindParam(':c3',$c3,PDO::PARAM_STR);
  $query->bindParam(':c4',$c4,PDO::PARAM_STR);
  $query->bindParam(':c5',$c4,PDO::PARAM_STR);
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
                <li class="nav-item"><a class="nav-link active" href="#companydetail" data-toggle="tab">Add Camps Attended</a></li>
                
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
                         
                         <input id="c1" name="c1" class="form-control" value="<?php  echo $row['c1'];?>" >
                            
                       </div>
                       <!-- /.form-group -->
                     </div>
                     <div class="col-md-8">
                      <div class="form-group">
                        <label for="Camp 2">Camp 2</label>
                        <select id="c2" name="c2" class="form-control" value="<?php  echo $row['c2'];?>" >
                        <option>Select Camp</option>
                            <option value="CATC 1">CATC 1</option>
                            <option value="CATC 2">CATC 2</option>
                            <option value="EBSB">EBSB</option>
                            <option value="ATTATCHMENT">ATTATCHMENT</option>
                            <option value="AITE">AITE</option>
                            <option value="VSC 1">VSC 1</option>
                            <option value="VSC 2">VSC 2</option>
                            <option value="VSC 3">VSC 3</option>
                            <option value="AIVSC">AIVSC</option>
                            <option value="pre IGC">pre IGC</option>
                            <option value="IGC">IGC</option>
                            <option value="Pre RDC 1">pre RDC 1</option>
                            <option value="Pre RDC 2">pre RDC 2</option>
                            <option value="Pre RDC 3">pre RDC 3</option>
                            <option value="RDC">RDC</option>
                            <option value="IDSSC">IDSSC</option>
                            <option value="YEP">YEP</option>
                          </select>
                      </div>        
                    </div>
                    <!-- /.col -->
                  </div><!-- ./row -->

                  <div class="row">
                    <div class="col-md-8">
                      <div class="form-group">
                      <label for="Camp 3">Camp 3</label>
                        <select id="c3" name="c3" class="form-control" value="<?php  echo $row['c3'];?>" >
                        <option>Select Camp</option>
                            <option value="CATC 1">CATC 1</option>
                            <option value="CATC 2">CATC 2</option>
                            <option value="EBSB">EBSB</option>
                            <option value="ATTATCHMENT">ATTATCHMENT</option>
                            <option value="AITE">AITE</option>
                            <option value="VSC 1">VSC 1</option>
                            <option value="VSC 2">VSC 2</option>
                            <option value="VSC 3">VSC 3</option>
                            <option value="AIVSC">AIVSC</option>
                            <option value="pre IGC">pre IGC</option>
                            <option value="IGC">IGC</option>
                            <option value="Pre RDC 1">pre RDC 1</option>
                            <option value="Pre RDC 2">pre RDC 2</option>
                            <option value="Pre RDC 3">pre RDC 3</option>
                            <option value="RDC">RDC</option>
                            <option value="IDSSC">IDSSC</option>
                            <option value="YEP">YEP</option>
                          </select>
                       
                        
                      </div>        
                    </div>
                    <div class="col-md-8">
                      <div class="form-group">
                      <label for="Camp 4">Camp 4</label>
                      <select id="c4" name="c4" class="form-control" value="<?php  echo $row['c4'];?>" >
                      <option>Select Camp</option>
                            <option value="CATC 1">CATC 1</option>
                            <option value="CATC 2">CATC 2</option>
                            <option value="EBSB">EBSB</option>
                            <option value="ATTATCHMENT">ATTATCHMENT</option>
                            <option value="AITE">AITE</option>
                            <option value="VSC 1">VSC 1</option>
                            <option value="VSC 2">VSC 2</option>
                            <option value="VSC 3">VSC 3</option>
                            <option value="AIVSC">AIVSC</option>
                            <option value="pre IGC">pre IGC</option>
                            <option value="IGC">IGC</option>
                            <option value="Pre RDC 1">pre RDC 1</option>
                            <option value="Pre RDC 2">pre RDC 2</option>
                            <option value="Pre RDC 3">pre RDC 3</option>
                            <option value="RDC">RDC</option>
                            <option value="IDSSC">IDSSC</option>
                            <option value="YEP">YEP</option>
                          </select>

                  </div>
                  
                  <div class="col-md-16">
                      <div class="form-group">
                      <label for="Camp 5">Camp 5</label>
                      <select id="c5" name="c5" class="form-control" value="<?php  echo $row['c5x'];?>" >
                      <option>Select Camp</option>
                            <option value="CATC 1">CATC 1</option>
                            <option value="CATC 2">CATC 2</option>
                            <option value="EBSB">EBSB</option>
                            <option value="ATTATCHMENT">ATTATCHMENT</option>
                            <option value="AITE">AITE</option>
                            <option value="VSC 1">VSC 1</option>
                            <option value="VSC 2">VSC 2</option>
                            <option value="VSC 3">VSC 3</option>
                            <option value="AIVSC">AIVSC</option>
                            <option value="pre IGC">pre IGC</option>
                            <option value="IGC">IGC</option>
                            <option value="Pre RDC 1">pre RDC 1</option>
                            <option value="Pre RDC 2">pre RDC 2</option>
                            <option value="Pre RDC 3">pre RDC 3</option>
                            <option value="RDC">RDC</option>
                            <option value="IDSSC">IDSSC</option>
                            <option value="YEP">YEP</option>
                          </select>
                                               
                   
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