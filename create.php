<?php 
 require_once "config.php";

$name = $address = $salary ="";
$name_err = $address_err = $salary_err = "";

if($_SERVER["REQUEST_METHOD"]=="POST"){

    // vaild name
    $temp_name = trim($_POST['name']);
    if(empty($temp_name))
    {
        $name_err = "Please enter a name";
    }
    elseif(!filter_var(trim($_POST["name"]), FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z'-.\s ]+$/")))){
        $name_err="Please enter valid name";
    }
    else{
        $name = $temp_name;
        
    }
    // vaild address
    $temp_address = $_POST['address'];
    if(empty($temp_address))
    {
        $address_err = "Please enter a address";
    }
    else
    {
        $address = $temp_address;
        
    }
// vaild salary
    $temp_salary = $_POST['salary'];
    if(empty($temp_salary))
    {
        $salary_err="Please enter a salary";
    }
    elseif(!ctype_digit($temp_salary))
    {
        $salary_err = "Please enter a positive value";
    }
    else{
        $salary = $temp_salary;
        
    }
    if(empty($name_err) && empty($address_err) && empty($salary_err)){

        $sql = "INSERT INTO employees (name,address,salary) VALUES (?,?,?)";
        

        if($stmt=mysqli_prepare($link,$sql))
        {
            mysqli_stmt_bind_param($stmt,"sss",$param_name,$param_address,$param_salary);

            $param_name = $name;
            $param_address = $address;
            $param_salary = $salary;
            

            if(mysqli_stmt_execute($stmt))
            {
                header("location: index.php");
                exit();
            }
            else
            {
                echo "Something went wrong. Please try again later";
            }
            
        }
        mysqli_stmt_close($stmt);
    }
    mysqli_close($link);
}

?>

<html lang="en">
<head>
<title>Dashboard</title>
<meta charset="utf-8">
    <!-- bootstrap and jquery -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <style type="text/css">
    .wrapper{
        width : 500px;
        margin:0 auto;

    }
    </style>
</head>

<body>
<div class="wrapper">
    <div class = "container-fluid">
        <div class = "row">
            <h2 class = "col-md-12">
                <h2 class = "page-header">Create Records</h2>
                <p>Please fill in form and submit to add employees records to the database</p>
                <form action="<? echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method ="post">


                <div class="form-group <? echo (!empty($name_err))? 'has-error':'has-success';?>">
                    <label for="NAME">NAME</label>
                    <input type="text" name="name" class="form-control" value="<? echo $name;?>">
                    <span class="help-block"><? echo $name_err ;?></span>
                </div>

                <div class="form-group <? echo (!empty($address_err))? 'has-error':'has-success';?>">
                    <label for="address">Address</label>
                    <input type="text" class="form-control"name="address" value='<? echo $address; ?>'>
                    <span class="help-block"><? echo $address_err ;?></span>
                </div>

                <div class="form-group <? echo (!empty($salary_err))? 'has-error':'has-success';?>">
                    <label for="salary">Salary</label>
                    <input type="text" class="form-control" name="salary" value='<? echo $salary;?>'>
                    <span class ="help-block"><? echo $salary_err;?></span>
                </div>

                <input type="submit" class="btn btn-primary">
                <a href="index.php" class="btn btn-default">Cancel</a> 
                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>