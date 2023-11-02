<?php
session_start();
if(!isset($_SESSION['email'])){
  header("Location: login.php");
}

if($_SESSION['role'] == "user"){
    header("Location: login.php");
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management System</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css">
    

</head>
<body>

<div class="main-container d-flex">
        <div class="sidebar" id="side_nav">
            <div class="header-box px-2 pt-3 pb-4 d-flex justify-content-between">
                <h1 class="fs-4"><span class="bg-white text-dark rounded shadow px-2 me-2">Ostad</span> <span
                        class="text-white"><?php echo $_SESSION['role'];?></span></h1>
                <button class="btn d-md-none d-block close-btn px-1 py-0 text-white"><i
                        class="fal fa-stream"></i></button>
            </div>

            <ul class="list-unstyled px-2">
                <li class="active"><a href="#Dashboard" class="text-decoration-none px-3 py-2 d-block">
                  <i class="fal fa-home"></i> Dashboard</a></li>

                <li class=""><a href="#TotalList" class="text-decoration-none px-3 py-2 d-block d-flex justify-content-between">
                        <span><i class="fal fa-list"></i> Total Lists</span>
                        
                    </a>
                </li>

                <li class=""><a href="#UserList" class="text-decoration-none px-3 py-2 d-block d-flex justify-content-between">
                        <span><i class="fal fa-user"></i> Users Lists</span>
                    </a>
                </li>

                <li class=""><a href="#AdminList" class="text-decoration-none px-3 py-2 d-block d-flex justify-content-between">
                        <span><i class="fal fa-user-secret"></i> Admin Lists</span>
                    </a>
                </li>

                <li class=""><a href="#" class="text-decoration-none px-3 py-2 d-block"><i class="fal fa-user-cog"></i>  Manage Settings</a></li>

                <!-- <li class=""><a href="#" class="text-decoration-none px-3 py-2 d-block"><i class="fal fa-users"></i>  Customers</a></li> -->
            </ul>
            <hr class="h-color mx-2">

            <ul class="list-unstyled px-2">
                <li class=""><a href="logout.php" class="text-decoration-none px-3 py-2 d-block">
                  <i class="fal fa-user"></i> Log Out</a></li>
                <li class=""><a href="#" class="text-decoration-none px-3 py-2 d-block">
                  <i class="fal fa-bell"></i> Notifications</a></li>
            </ul>

        </div>
        <div class="content">
            <nav class="navbar navbar-expand-md navbar-light bg-light">
                <div class="container-fluid">
                    <div class="d-flex justify-content-between d-md-none d-block">
                     <button class="btn px-1 py-0 open-btn me-2"><i class="fal fa-stream"></i></button>
                        <a class="navbar-brand fs-4" href="#"><span class="bg-dark rounded px-2 py-0 text-white">CL</span></a>
                       
                    </div>
                    <button class="navbar-toggler p-0 border-0" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fal fa-bars"></i>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                        <ul class="navbar-nav mb-2 mb-lg-0">
                            <li class="nav-item">
                                <a class="nav-link active bg-primary px-3 rounded rounded-2" aria-current="page" href="#">Profile</a>
                            </li>

                        </ul>

                    </div>
                </div>
            </nav>

            <div class="dashboard-content px-3 pt-4">
                <h2 class="fs-5 mb-4" id="Dashboard" > Admin Dashboard</h2>
                <div class="card">
                  <div class="card-header">User Details</div>
                  <div class="card-body">
                    <h5 class="card-title">Name: <?php echo $_SESSION['username']; ?></h5>
                    <h5 class="card-title">Role: <?php echo $_SESSION['role']; ?></h5>
                    <p class="card-text">Email Address is : <?php echo $_SESSION['email']; ?> </p>
                  </div>
                </div>

                <div class="card mt-4 p-3">
                  <h2 class="fs-5 mt-4" id="TotalList" > Total Lists</h2>
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                          $serial = 1;
                          $fp = fopen("./database/users.txt","r");
                          while ($line = fgets($fp)){
                            $values = explode(",", $line);
                            $adRoles = trim($values[0]);
                            $email = trim($values[1]);
                            $Adpassword = trim($values[2]);
                            $username = trim($values[3]);
                            $info = "$adRoles, $email, $Adpassword, $username";

                            echo "<tr>
                            <th scope='row'>{$serial}</th>
                            <td> {$username} </td>
                            <td>{$email}</td>
                            <td>
                            <button onclick='myDelete({$serial})' class='btn btn-danger'>Delete
                            </button> 
                            <button onclick='myEdit({$serial})' class='btn btn-primary'> Edit
                            </button> 
                            <button onclick='makeAdmin({$serial})' class='btn btn-info'>Make Admin
                            </button>
                            </td>
                            </tr>";

                            $serial++;
                          }

                        ?>
                    </tbody>
                  </table>
                  </div>

                  <div class="card mt-4 p-3">
                  <h2 class="fs-5 mt-4" id="UserList" > User Lists</h2>
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                          $userfp = fopen("./database/users.txt","r");
                          $userserial = 1;
                          while ($line = fgets($userfp)){
                            $usersValues = explode(",", $line);
                            $userRoles = trim($usersValues[0]);
                            $userEmail = trim($usersValues[1]);
                            $UserUserName = trim($usersValues[3]);

                            if($userRoles == "user"){
                              echo "<tr>
                              <th scope='row'>{$userserial}</th>
                              <td> {$UserUserName} </td>
                              <td>{$userEmail}</td>
                              </tr>";

                              $userserial++;
                            }

                          }

                          //fclose($userfp);
                        ?>
                    </tbody>
                  </table>
                  </div>

                  
                  <div class="card mt-4 p-3">
                  <h2 class="fs-5 mt-4" id="AdminList" > Admin Lists</h2>
                  <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                          $Adminfp = fopen("./database/users.txt","r");
                          $Adminserial = 1;
                          while ($line = fgets($Adminfp)){
                            $AdminValues = explode(",", $line);
                            $AdminRoles = trim($AdminValues[0]);
                            $AdminEmail = trim($AdminValues[1]);
                            $AdminuserName = trim($AdminValues[3]);

                            if($AdminRoles == "admin"){
                              echo "<tr>
                              <th scope='row'>{$Adminserial}</th>
                              <td> {$AdminuserName} </td>
                              <td>{$AdminEmail}</td>
                              </tr>";

                              $Adminserial++;
                            }

                          }
                        ?>
                    </tbody>
                  </table>
                  </div>
                </div>
                
            </div>
        </div>
    </div>
  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
  <script src="js/script.js" ></script>
</body>
</html>