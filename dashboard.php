<?php require_once('./database/connection.php'); ?>

<?php
session_start();
if(!isset($_SESSION['user_id'])) {
    header('location: ./index.php');
}
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM `users` WHERE `id` = $user_id";
$result = $conn->query($sql);
$user = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>

    <div class="container">
        <div class="row mt-5">
            <div class="col-md-6 mx-auto">
                <div class="card">
                    <div class="card-header">
                    <div class="row">
                            <div class="col">
                                <h5>Dashboard</h5>
                            </div>
                            <div class="col text-end">
                                <a href="./edit.php?id=<?php echo $user_id; ?>" class="btn btn-outline-primary">Edit</a>
                                <a href="./logout.php" class="btn btn-outline-danger">Logout</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="lead">Welcome <strong>
                            <?php 
                            // echo $_SESSION['user_name'];
                            echo $user['name'];
                             ?>
                        </strong> to the page!</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>