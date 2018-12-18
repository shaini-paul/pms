<?php
require('server.php');
$update_status=0;
$create_status=0;
$id=0;
$inserted=0;
$newupdated=0;

// If form submitted, insert values into the database.
if (isset($_REQUEST['clientID']))
{
    $id = $_GET['clientID'];
    $query = "SELECT * FROM sb_clients WHERE clientID=".$id;
    $result = mysqli_query($db,$query);
    $rows = mysqli_num_rows($result);
        if($rows == 1)
        {
            while($row = mysqli_fetch_array($result)) 
            {
                $name = $row['name'];
                $email = $row['email'];
                $contactNo = $row['contactNo'];
                $projectName = $row['projectName'];
            }
            
        }
                
}
else
{
    $name = '';
    $email = '';
    $contactNo = '';
    $projectName = '';
}

if (isset($_REQUEST['submit']))
{
        // removes backslashes
    $name = $_REQUEST['name'];
    $email = $_REQUEST['email'];
    //escapes special characters in a string
    $contactNo = $_REQUEST['contactNo'];
    $projectName = $_REQUEST['projectName'];
    if (isset($_REQUEST['clientID']))
    {
        $Check = "SELECT * FROM  sb_clients WHERE name='".$name."' and email='".$email."' and contactNo='".$contactNo."' and  projectName='".$projectName."' ";
         $setresults= mysqli_query($db, $Check) or die(mysqli_error($db));
            mysqli_num_rows($setresults);
            if(mysqli_num_rows($setresults)) {
             $newupdated=1;               
            } 
            else
            {
                $newupdated=0;
                $query = "UPDATE `sb_clients` SET `name`='".$name ."',`email`='".$email."',`contactNo`='".$contactNo ."',`projectName`='".$projectName."' WHERE clientID=".$id;
                   if (mysqli_query($db, $query)) 
                   {
                        $update_status=1;  
                    } 
                    else{
                        $update_status=0;
                    }
            }
                
    }
    else
    {
         $newupdated=0;
        //Checking is user existing in the database or not
          $query = "INSERT INTO `sb_clients`(`clientID`, `name`, `email`, `contactNo`, `projectName`) VALUES (null, '".$name."', '".$email."', '".$contactNo."' ,'".$projectName."')";
            if (mysqli_query($db, $query)) 
            {
                $update_status=1;  
            } 
            else
            {
                $update_status=0;
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
        <?php include ('header.php');  ?><!-- /header -->
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


                <div class="row">
            

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <strong>Add Client</strong>  
                            </div>
                            <div class="card-body card-block">
                                <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Client Name</label></div>
                                        <div class="col-12 col-md-9"><input type="text" id="text-input" name="name" placeholder="Enter Name" class="form-control" value="<?php echo "$name"; ?>" required></div>
                                    </div>
                                    <div class="row form-group">
                                        <div class="col col-md-3"><label for="email-input" class=" form-control-label">Email Address</label></div>
                                        <div class="col-12 col-md-9"><input type="email" id="email-input" name="email" placeholder="Enter Email" class="form-control" value="<?php echo "$email"; ?>" required></div>
                                    </div>
                                         
                                        <div class="row form-group">
                                        <div class="col col-md-3"><label for="text-input" class=" form-control-label">Contact No</label></div>
                                        <div class="col-12 col-md-9"><input type="text" id="text-input" name="contactNo" placeholder="Enter Contact No" class="form-control" value="<?php echo "$contactNo"; ?>" required></div>
                                    </div>
                                        <div class="row form-group">
                                        <div class="col col-md-3"><label for="password-input" class=" form-control-label">Project Name</label></div>
                                        <div class="col-12 col-md-9"><input type="text" id="password-input" name="projectName" placeholder="Enter Project Name" class="form-control" value="<?=$projectName ?>" required></div>
                                    </div>
                                    <div class="card-footer">
                                <button type="submit" class="btn btn-primary btn-sm" name="submit">
                                    <i class="fa fa-dot-circle-o"></i> Submit
                                </button>
                                <?php if (!isset($_REQUEST['clientID'])){ ?>
                                <a href="add-client.php" class="btn btn-danger btn-sm">
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
}
</body>
</html>


