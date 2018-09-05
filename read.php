<?

if (isset($_GET['id']) && !empty(trim($_GET['id']))) {

    require_once 'config.php';

    $sql = "SELECT * from employees where id = ?";

    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, 'i', $param_id);

        $param_id = trim($_GET['id']);

        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                $name = $row['name'];

            } else {
                exit();
            }
        } else {

            exit();
        }

    }

    mysqli_stmt_close($stmt);

    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class ="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h2>View Records</h2>
                </div>
                <div class="form-group">
                    <label for="">Name</label>
                    <div class="form-control-static"><? echo $row['name'] ?></div>
                </div>
                <div class="form-group">
                    <label for="">Address</label>
                    <div class="form-control-static"><? echo $row['address'] ?></div>
                </div>
                <div class="form-group">
                    <label for="">Salary</label>
                    <div class="form-control-static"><? echo $row['salary'] ?></div>
                </div>
                <p> <a href="index.php" class="btn btn-primary" value="">Back</a></p>
            </div>
        </div>
    </div>
</body>
</html>
