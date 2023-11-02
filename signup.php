<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get user input
        $userName = $_POST['username'] ?? "";
        $email = $_POST['email'] ?? "";
        $password = $_POST['password'] ?? "";

        $errorMessage = "";

        if (!empty($userName) && !empty($email) && !empty($password)) {
            $fp = fopen("./database/users.txt", "a");
            fwrite($fp,"\nuser, {$email}, {$password}, {$userName}");
            fclose($fp);

            header("Location: login.php");
        } else {
            $errorMessage = "Please enter full details";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">

    <style>
        *{
            margin: 0;
            padding: 0;
        }

        body{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-color: #F8F9FA;
        }

        .container{
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .mybutton{
            width: 100%;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="shadow-sm p-3 mb-5 bg-body-tertiary rounded">
        <div class="card" style="width: 30rem;">
                <div class="card-body">
                <center class="mb-3" > <h5>Create An Account</h5> </center>
                    <form method="post" action="">
                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Username</span>
                            <input type="text" name="username" class="form-control" placeholder="Enter your last name" aria-label="Username" aria-describedby="basic-addon1">
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Email &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span>
                            <input type="email" name="email" class="form-control" placeholder="example@gmail.com" aria-label="Username" aria-describedby="basic-addon1">
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">Password &nbsp;</span>
                            <input type="password" name="password" class="form-control" placeholder="******" aria-label="Username" aria-describedby="basic-addon1">
                        </div>

                        <button type="submit" class="btn btn-primary mt-3 mb-3 mybutton">Sign Up</button>
                        <div>
                            <p class="text-center">Already have an <a href="login.php">Account ?</a></p>
                        </div>
                        <div>
                            <p> <?php echo $errorMessage ?? ''?> </a></p>
                        </div>
                    </form>

                    <div id="result">
                        <?php
                            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                // Get user input
                            
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>