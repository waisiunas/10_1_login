<?php require_once('./database/connection.php'); ?>

<?php
session_start();
if(isset($_SESSION['user_id'])) {
    header('location: ./dashboard.php');
}

$name = $email = "";
if (isset($_POST['submit'])) {
    // echo "<pre>";
    // print_r($_POST);
    // echo "</pre>";

    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $confirm_password = htmlspecialchars($_POST['confirm_password']);

    if (empty($name)) {
        $error = "Enter your Name!";
    } elseif (empty($email)) {
        $error = "Enter your Email!";
    } elseif (empty($password)) {
        $error = "Enter your Password!";
    } elseif ($password !== $confirm_password) {
        $error = "Confirm your Password!";
    } else {
        $sql = "SELECT * FROM `users` WHERE `email` = '$email'";
        $result = $conn->query($sql);
        $new_password = md5($password);
        if($result->num_rows == 0) {
            $sql = "INSERT INTO `users`(`name`, `email`, `password`) VALUES ('$name','$email','$new_password')";
            if($conn->query($sql)) {
                $success = 'Magic has been spelled!';
            } else {
                $error = 'Magic has failed to spell!';
            }
        } else {
            $error = "Email already exists!";
        }
    }
}
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
                        <h5 class="text-center">Registration</h5>
                    </div>
                    <div class="card-body">

                        <?php
                        if (!empty($error)) { ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?php echo $error; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php
                        }

                        if (!empty($success)) { ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <?php echo $success; ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php
                        }
                        ?>

                        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">

                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" id="name" value="<?php echo $name; ?>" placeholder="Enter your Name!">
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" id="email" value="<?php echo $email; ?>" placeholder="Enter your Email!">
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Enter your Password!">
                            </div>

                            <div class="mb-3">
                                <label for="confirm_password" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="Confirm your Password!">
                            </div>

                            <div class="mb-3">
                                <input type="submit" class="btn btn-primary" name="submit">
                                <input type="reset" class="btn btn-dark">
                            </div>

                        </form>

                        <hr>

                        <p class="lead">Already registered? <a href="./index.php">Login</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>

</html>