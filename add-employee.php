<?php
require('server.php');
$update_status=0;
$create_status=0;
$id=0;
$inserted=0;
$newupdated=0;

// If form submitted, insert values into the database.
if (isset($_REQUEST['employeeID'])){
$id = $_GET['employeeID'];
// $query = "SELECT sb_employee.employeeID, sb_employee.name, sb_employee.email, sb_departments.name as dname,sb_departments.departmentID, sb_employee.position, sb_employee.username, sb_employee.password FROM sb_employee
//               INNER JOIN sb_departments
//               ON sb_employee.departmentID=sb_departments.departmentID WHERE sb_employee.employeeID=".$id;
$query = "SELECT * FROM sb_employee
              WHERE employeeID=".$id;
   $result = mysqli_query($db,$query);
   $rows = mysqli_num_rows($result);

        if($rows == 1){
             while($row = mysqli_fetch_array($result)) {
              $name = $row['name'];
                $email = $row['email'];
                $departmentID=$row['departmentID'];
                $roleID= $row['roleID'];
                $username = $row['username'];
                $password = $row['password'];
             }
            
         }
         
       
}
else{
            $name = '';
            $email = '';
            $department = '';
            $departmentID ='';
            $roleID ='';
            $username = '';
            $password = '';
         }

if (isset($_REQUEST['submit'])){
        // removes backslashes
    $name = $_REQUEST['employee-name'];
    $email = $_REQUEST['email-address'];
    $departmentID = $_REQUEST['departmentID'];
    $roleID = $_REQUEST['roleID'];
    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];
    if (isset($_REQUEST['employeeID'])){
         $Check = "SELECT * FROM  sb_employee WHERE name='".$name."' and email='".$email."' and departmentID='".$departmentID."' and  roleID='".$roleID."' and username='".$username."' ";
         $setresults= mysqli_query($db, $Check) or die(mysqli_error($db));
        mysqli_num_rows($setresults);
            if(mysqli_num_rows($setresults)) {
             $newupdated=1;               
            } 
            else{
                $newupdated=0;
                $query = "UPDATE `sb_employee` SET `name`='".$name ."',`email`='".$email."',`departmentID`='".$departmentID ."',`roleID`='".$roleID."',`username`='".$username."',`password`='".$password."' WHERE employeeID=".$id;
                   if (mysqli_query($db, $query)) {
                        $update_status=1;  
                    } 
                    else{
                        $update_status=0;
                    }
            }

    
    }        
                
    else {

        //Checking is user existing in the database or 
             $Checking = "SELECT * FROM  sb_employee WHERE email='".$email."'";
             $setresult= mysqli_query($db, $Checking) or die(mysqli_error($db));
            mysqli_num_rows($setresult);
            if(mysqli_num_rows($setresult)) {   
                $inserted = 1;
            }else{
                $query = "INSERT INTO `sb_employee`(`employeeID`, `name`, `email`, `departmentID`, `roleID`, `username`, `password`) VALUES (null, '".$name."', '".$email."','".$departmentID."','".$roleID."', '".$username."' ,'".$password."')";
                if (mysqli_query($db, $query)) {
                    $create_status=1; 
                } else {
                    echo "Error: " . $query . "<br>" . mysqli_error($db);
                    $create_status=0;
                }
            }
    }
}
?>



<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" lang="en">
<!--<![endif]-->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sufee Admin - HTML5 Admin Template</title>
    <meta name="description" content="Sufee Admin - HTML5 Admin Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="apple-touch-icon" href="apple-icon.png">
    <link rel="shortcut icon" href="favicon.ico">


    <link rel="stylesheet" href="vendors/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="vendors/themify-icons/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="vendors/selectFX/css/cs-skin-elastic.css">

    <link rel="stylesheet" href="assets/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>



</head>

<body>
    <!-- Left Panel -->

<?php include ('left-sidebar.php');  ?>
    <!-- /#left-panel -->

    <!-- Left Panel -->

    <!-- Right Panel -->

    <div id="right-panel" class="right-panel">

        <!-- Header-->
       <?php include ('header.php');  ?>
       <!-- /header -->
        <!-- Header-->

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Dashboard</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="#">Dashboard</a></li>
                            <li><a href="#">Forms</a></li>
                            <li class="active">Basic</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
<?php 
if($update_status==1){
    echo "<div class='sufee-alert alert with-close alert-primary alert-dismissible fade show'>
                                        <span class='badge badge-pill badge-primary'>Success</span>
                                        Employee recoard updated successfully.
                                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                                <span aria-hidden='true'>&times;</span>
                                            </button>
                                    </div>";
}
elseif ($create_status==1) {
    echo "<div class='sufee-alert alert with-close alert-primary alert-dismissible fade show'>
                                        <span class='badge badge-pill badge-primary'>Success</span>
                                        New employee added successfully.
                                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                                <span aria-hidden='true'>&times;</span>
                                            </button>
                                    </div>";
}
elseif ($inserted==1) {
    # code...
    echo "<div class='sufee-alert alert with-close alert-primary alert-dismissible fade show'>
                                        <span class='badge badge-pill badge-primary'>Success</span>
                                        This email is already being used.
                                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                                <span aria-hidden='true'>&times;</span>
                                            </button>
                                    </div>";
}

elseif ($newupdated==1) {
    # code...
    echo "<div class='alert alert-danger'>
                                        
                                        This data is already existing.
                                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                                <span aria-hidden='true'>&times;</span>
                                            </button>
                                    </div>";
}

?>



            <div class="animated fadeIn">


                <div class="row">
            

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <strong>Add Employee</strong>  
                            </div>
                            <div class="card-body card-block">
                                <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Employee Name</label></div>
                                        <div class="col-12 col-md-9"><input type="text" id="text-input" name="employee-name" placeholder="Enter Name" class="form-control" value="<?php echo "$name"; ?>" required></div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="email-input" class=" form-control-label">Email Address</label></div>
                                        <div class="col-12 col-md-9"><input type="email" id="email-input" name="email-address" placeholder="Enter Email" class="form-control" value="<?php echo "$email"; ?>" required></div>
                                    </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="select" class=" form-control-label">Department</label></div>
                                            <div class="col-12 col-md-9">
                                                <select required name="departmentID" id="select" class="form-control">
                                                    <option value="">Please Select</option>
                                                    <option value="1" <?php if($departmentID==1){echo "selected";} ?>>.Net</option>
                                                    <option value="2" <?php if($departmentID==2){echo "selected";} ?>>PHP</option>
                                                    <option value="3" <?php if($departmentID==3){echo "selected";} ?>>Mean Stack</option>
                                                    <option value="4" <?php if($departmentID==4){echo "selected";} ?>>Android</option>
                                                    <option value="5" <?php if($departmentID==5){echo "selected";} ?>>IOS</option>
                                                    <option value="6" <?php if($departmentID==6){echo "selected";} ?>>Testing</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="select" class=" form-control-label">Select Position</label></div>
                                            <div class="col-12 col-md-9">
                                                <select required name="roleID" id="select" class="form-control" >
                                                    <option value="">Please Select</option>
                                                    <option value="1" <?php if($roleID== '1'){echo "selected";} ?>>Project Manager</option>
                                                    <option value="2" <?php if($roleID== '2'){echo "selected";} ?>>Ass. Project Manager</option>
                                                    <option value="3" <?php if($roleID== '3'){echo "selected";} ?>>Team Leader</option>
                                                    <option value="4" <?php if($roleID== '4'){echo "selected";} ?>>Ass. Team Leader</option>
                                                    <option value="5" <?php if($roleID== '5'){echo "selected";} ?>>Jr. Developer</option>
                                                    <option value="6" <?php if($roleID== '6'){echo "selected";} ?>>Sr. Developer</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Username</label></div>
                                        <div class="col-12 col-md-9"><input type="text" id="text-input" name="username" placeholder="Enter Username" class="form-control" value="<?php echo "$username"; ?>" required></div>
                                    </div>
                                        <div class="row form-group">
                                        <div class="col col-md-3"><label for="password-input" class=" form-control-label">Password</label></div>
                                        <div class="col-12 col-md-9"><input type="password" id="password-input" name="password" placeholder="Password" class="form-control" value="<?php echo "$password"; ?>" required><small class="help-block form-text">Please enter a complex password</small></div>
                                    </div>
                                    <div class="card-footer">
                                <button type="submit" class="btn btn-primary btn-sm" name="submit">
                                    <i class="fa fa-dot-circle-o"></i> Submit
                                </button>
                                <?php if (!isset($_REQUEST['employeeID'])){ ?>
                                <a href="add-employee.php" class="btn btn-danger btn-sm">
                                    <i class="fa fa-ban"></i> Reset</a>
                                <?php }?>
                            </div>
                                </form>
                            </div>
                            
                        </div>
                    </div>

                    <script src="vendors/jquery/dist/jquery.min.js"></script>
                    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>

                    <script src="vendors/jquery-validation/dist/jquery.validate.min.js"></script>
                    <script src="vendors/jquery-validation-unobtrusive/dist/jquery.validate.unobtrusive.min.js"></script>

                    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
                    <script src="assets/js/main.js"></script>
</body>
</html>