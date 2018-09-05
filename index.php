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
            width: 800px;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
    </script>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left"> Employess Details</h2>
                        <a href="create.php" class="pull-right btn btn-success">Add New Employees</a>
                    </div>
                    <?php 
                    require_once "config.php";

                    $sql = "SELECT * from employees";
                    if ($result = mysqli_query($link, $sql)) {
                        if (mysqli_num_rows($result) > 0) {
                            echo "
                                <table class='table table-bordered table-striped'>
                                    <thead>
                                        <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>Salary</th>
                                        <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>";
                            while ($row = mysqli_fetch_array($result)) {
                                echo "<tr>";
                                echo "<td>" . $row['id'] . "</td>";
                                echo "<td>" . $row['name'] . "</td>";
                                echo "<td>" . $row['address'] . "</td>";
                                echo "<td>" . $row['salary'] . "</td>";
                                echo "<td><a href ='read.php?id=" . $row['id'] . "' title='View Record' data-toggle='tooptip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                                echo "<a href ='update.php?id=" . $row['id'] . "' title='Update Record' data-toggle='tooptip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                echo "<a href ='delete.php?id=" . $row['id'] . "' title='Delete Record' data-toggle='tooptip'><span class='glyphicon glyphicon-trash'></span></a></td>";
                                echo "</tr>";


                            }
                            echo "</tbody>";
                            echo "</table>";
                            mysqli_free_result($result);
                        } else {
                            echo "<p class='lead'><em>No records were found</em></p>";
                        }
                    } else {
                        echo "ERORR : Could not able to execute $sql." . mysqli_error($link);

                    }
                    mysqli_close($link);
                    ?>            
                </div>
            </div>
        </div>
    </div>
</body>
</html>