<?php
require('server.php');
// If form submitted, insert values into the database.
if (isset($_REQUEST['projectID']))
{
    $id    = $_GET['projectID'];
    $query = "SELECT sb_projects.projectID, sb_employees.name, sb_employees.email, sb_departments.name as dname,
                     sb_departments.departmentID, sb_employees.position, sb_employees.username, 
                     sb_employees.password FROM sb_employees
              INNER JOIN sb_departments
              ON sb_employees.departmentID=sb_departments.departmentID WHERE sb_employees.employeeID=".$id;
   $result = mysqli_query($db,$query);
   $rows   = mysqli_num_rows($result);

    if($rows == 1)
    {
        while($row = mysqli_fetch_array($result)) 
        {
            $title         =  $row['title'];
            $description   =  $row['description'];
            $projectCode   =  $row['projectCode'];
            $startDate     =  $row['startDate'];
            $clientID      =  $row['clientID'];
            $Attachment    =  $row['Attachment'];
            $employeeID    =  $row['employeeID'];
            $projectStatus =  $row['projectStatus'];
            $departmentID  =  $row['departmentID'];
        } 
    }              
}
else
{
    $title         =  '';
    $description   =  '';
    $projectCode   =  '';
    $startDate     =  '';
    $clientID      =  '';
    $Attachment    =  '';
    $employeeID    =  '';
    $projectStatus =  '';
    $departmentID  =  '';
}

if (isset($_REQUEST['submit']))
{
    $title         =  $_REQUEST['title'];
    $description   =  $_REQUEST['description'];
    $projectCode   =  $_REQUEST['projectCode'];
    $startDate     =  $_REQUEST['startDate'];
    $clientID      =  $_REQUEST['clientID'];
    $Attachment    =  $_REQUEST['Attachment'];
    $employeeID    =  $_REQUEST['employeeID'];
    // $projectStatus =  $_REQUEST['projectStatus'];
    $departmentID  =  $_REQUEST['departmentID'];

    $query         =  "INSERT INTO `sb_projects`(`projectID`, `title`, `description`, `projectCode`, `startDate` , `clientID`, 
                                                 `Attachment`, `employeeID`, `projectStatus`, `departmentID`) 
                                         VALUES (null, '".$title."', '".$description."', '".$projectCode."' ,'".$startDate."',
                                                '".$clientID."','".$Attachment."','".$employeeID."','".$projectStatus."',
                                                '".$departmentID."')";
    if (mysqli_query($db, $query)) 
    {
        echo "New record created successfully";
    } 
    else 
    {
        echo "Error: " . $query . "<br>" . mysqli_error($db);
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
            <div class="animated fadeIn">
                <div class="row">       
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <strong>Add Project</strong>  
                            </div>
                            <div class="card-body card-block">
                                <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Project Title</label></div>
                                        <div class="col-12 col-md-9"><input type="text" id="text-input" name="title" placeholder="Enter Name" class="form-control" value="<?php //echo "$title"; ?>"></div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Project Code</label></div>
                                        <div class="col-12 col-md-9"><input type="text" id="text-input" name="projectCode" placeholder="Enter Name" class="form-control" value="<?php //echo "$projectCode"; ?>"></div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Project Description</label></div>
                                        <div class="col-12 col-md-9"><input type="text" id="text-input" name="description" placeholder="Enter Name" class="form-control" value="<?php //echo "$description"; ?>"></div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Start Date</label></div>
                                        <div class="col-12 col-md-9"><input type="text" id="text-input" name="startDate" placeholder="Enter Name" class="form-control" value="<?php //echo "$startDate"; ?>"></div>
                                    </div>
                                    <div class="row form-group">
                                            <div class="col col-md-3"><label for="select" class=" form-control-label">Client</label></div>
                                            <div class="col-12 col-md-9">
                                                <select required name="clientID" id="select" class="form-control">
                                              <option value="">Please Select</option>
                                              <?php
                                            $query = "SELECT * From sb_clients";
                                               $result = mysqli_query($db,$query) or die(mysql_error());
                                               $rows = mysqli_num_rows($result);
                                                if ($result->num_rows > 0) 
                                                {
                                                    // output data of each row
                                                    $i=1;
                                                    while($row = $result->fetch_assoc()) 
                                                    {
                                                        echo $row['name'];
                                               
                                              ?>  
                                                  
                                                   <option value="<?=$row['clientID']?>"><?=$row['name']?></option>
                                                    <?php 
 }
 }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3"><label for="select" class=" form-control-label">Department</label></div>
                                            <div class="col-12 col-md-9">
                                                <select required name="departmentID" id="select" class="form-control">
                                                    <option value="">Please Select</option>
                                                    <?php
                                            $query = "SELECT * From sb_departments";
                                               $result = mysqli_query($db,$query) or die(mysql_error());
                                               $rows = mysqli_num_rows($result);
                                                if ($result->num_rows > 0) 
                                                {
                                                    // output data of each row
                                                    $i=1;
                                                    while($row = $result->fetch_assoc()) 
                                                    {
                                                        echo $row['name'];
                                              ?>  
                                                    <option value="<?=$row['departmentID']?>"><?=$row['name']?></option>
                                                    <?php 
                                                 }
                                                 }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row form-group">
                                            <div class="col col-md-3">
                                                <label for="select" class=" form-control-label">Responsible Person</label>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <select required name="employeeID" id="select" class="form-control">
                                                    <option value="">Please Select</option>
                                                    <?php
                                            $query = "SELECT * From sb_employee";
                                               $result = mysqli_query($db,$query) or die(mysql_error());
                                               $rows = mysqli_num_rows($result);
                                                if ($result->num_rows > 0) 
                                                {
                                                    // output data of each row
                                                    $i=1;
                                                    while($row = $result->fetch_assoc()) 
                                                    {
                                                        echo $row['name'];
                                               
                                              ?>  
                                                    <option value="<?=$row['employeeID']?>"><?=$row['name']?></option>
                                                    <?php 
                                                 }
                                                 }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    <!-- <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Client ID</label></div>
                                        <div class="col-12 col-md-9"><input type="text" id="text-input" name="employee-name" placeholder="Enter Name" class="form-control" value="<?php //echo "$name"; ?>"></div>
                                    </div> -->
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Attachment</label></div>
                                        <div class="col-12 col-md-9"><input type="text" id="text-input" name="Attachment" placeholder="Enter Name" class="form-control" value="<?php echo "$Attachment"; ?>"></div>
                                    </div>
                                    <!-- <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Employee ID</label></div>
                                        <div class="col-12 col-md-9"><input type="text" id="text-input" name="employee-name" placeholder="Enter Name" class="form-control" value="<?php //echo "$name"; ?>"></div>
                                    </div> -->
                                    <!-- <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Department ID</label></div>
                                        <div class="col-12 col-md-9"><input type="text" id="text-input" name="employee-name" placeholder="Enter Name" class="form-control" value="<?php //echo "$name"; ?>"></div>
                                    </div> -->
                                    
                                    <div class="card-footer">
                                <button type="submit" class="btn btn-primary btn-sm" name="submit">
                                    <i class="fa fa-dot-circle-o"></i> Submit
                                </button>
                                <button type="reset" class="btn btn-danger btn-sm">
                                    <i class="fa fa-ban"></i> Reset
                                </button>
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