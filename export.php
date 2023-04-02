<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['sid']==0)) {
header('location:logout.php');
} 
?>
<?php
// Connect to the MySQL database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sdmsdb";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Handle the form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the table name from the form data
    $table = $_POST['table'];
    $selected_columns = isset($_POST['columns']) ? explode(",", $_POST['columns']) : array();

    // Get the column names
    $result = mysqli_query($conn, "SHOW COLUMNS FROM `$table`");
    $columns_array = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $columns_array[] = $row['Field'];
    }
    $columns = $selected_columns ? $selected_columns : $columns_array;

    // Get the data from the table
    $data = array();
    $result = mysqli_query($conn, "SELECT * FROM `$table`");
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }

    // Create the Excel file
    $filename = "export.xls";
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=\"$filename\"");

    // Write the column names to the Excel file
    if (is_array($columns) && count($columns) > 0) {
        echo implode("\t", $columns) . "\n";
    }

    // Write the data to the Excel file
    foreach ($data as $row) {
        $values = array();
        foreach ($columns as $column) {
            $value = isset($row[$column]) ? $row[$column] : "";
            $values[] = '"' . str_replace('"', '""', $value) . '"';
        }
        echo implode("\t", $values) . "\n";
    }

    // Close the database connection
    mysqli_close($conn);

    // Exit the script
    exit();
}

// Get the list of tables in the database
$tables = array();
$result = mysqli_query($conn, "SHOW TABLES");
while ($row = mysqli_fetch_row($result)) {
    $tables[] = $row[0];
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<?php @include("includes/head.php"); ?>
<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <?php @include("includes/header.php"); ?>
        <!-- Main Sidebar Container -->
        <?php @include("includes/sidebar.php"); ?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                <!DOCTYPE html>
<html>
<head>
    <title>Export MySQL Table to Excel</title>
</head>
<body>
    <form method="POST">
        
        <select name="table">
            <?php foreach ($tables as $table): ?>
                <option value="students"></option>
            <?php endforeach; ?>
        </select><br><br>
        <label for="columns" style="font-size: 1.5em;font-family: Source Sans Pro;">Select Attributes in the order to be saved:</label><br>

        <input type="text" name="columns" id="selected_options" value="" size="100"><br><br>


<div style="display: flex; flex-wrap: wrap;">
  <div style="flex-basis: 50%; font-size: 1.4em;">
    <input type="checkbox" name="option1" value="rank" onclick="updateTextInput(this)">Rank<br>
    <input type="checkbox" name="option2" value="studentName" onclick="updateTextInput(this)">Name<br>
    <input type="checkbox" name="option3" value="regtno" onclick="updateTextInput(this)">Regimental No.<br>
    <input type="checkbox" name="option4" value="studentno" onclick="updateTextInput(this)">Registration No<br>
    <input type="checkbox" name="option5" value="class" onclick="updateTextInput(this)">Class/Section<br>
    <input type="checkbox" name="option6" value="dept" onclick="updateTextInput(this)">Department<br>
    <input type="checkbox" name="option7" value="phone" onclick="updateTextInput(this)">Mobile No.<br>
    <input type="checkbox" name="option8" value="aadh" onclick="updateTextInput(this)">Aadhar No.<br>
    <input type="checkbox" name="option9" value="father" onclick="updateTextInput(this)">Father's Name.<br>
  </div>
  <div style="flex-basis: 50%; font-size: 1.4em;">
  <input type="checkbox" name="option10" value="mother" onclick="updateTextInput(this)">Mother's Name<br>
    <input type="checkbox" name="option11" value="gender" onclick="updateTextInput(this)">Gender<br>
    <input type="checkbox" name="option12" value="dob" onclick="updateTextInput(this)">DOB<br>
    <input type="checkbox" name="option13" value="address" onclick="updateTextInput(this)">Adress<br>
    <input type="checkbox" name="option15" value="bld" onclick="updateTextInput(this)">Blood Group<br>
    <input type="checkbox" name="option16" value="age" onclick="updateTextInput(this)">Age<br>
    <input type="checkbox" name="option17" value="f1,f2,f3,f4" onclick="updateTextInput(this)">Firing Training<br>
    <input type="checkbox" name="option18" value="s1,s2,s3,s4" onclick="updateTextInput(this)">Sorties<br>
    <input type="checkbox" name="option19" value="c1,c2,c3,c4,c5" onclick="updateTextInput(this)">Camp Details<br>
  </div>
</div>


<script>
var selected_options = [];

function updateTextInput(checkbox) {
  if (checkbox.checked) {
    selected_options.push(checkbox.value);
  } else {
    selected_options.splice(selected_options.indexOf(checkbox.value), 1);
  }
  document.getElementById("selected_options").value = selected_options.join(",");
}
</script>


        
       

        
<div style="display: flex; justify-content: center;">
  <button type="submit" style="font-size: 1.5em; margin-top:30px; margin-right: 400px">Export Table to Excel</button>
</div>

    </form>

</body>
</html>

                    <!-- Small boxes (Stat box) -->
                    <div class="row">
                        <div class="col-lg-4 col-6">
                            <!-- small box -->
                            
                            
                        
                        <!-- ./col -->
                       
                        <!-- ./col -->
                        <!-- ./col -->
                    </div>
                </div>
                <!-- /.row (main row) -->
            </div>
            <!-- /.container-fluid -->
        </section>
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
</body>
</html>