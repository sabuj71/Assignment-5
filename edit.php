<?php 

session_start();
if(!isset($_SESSION['email'])){
  header("Location: login.php");
}

if($_SESSION['role'] == "user"){
    header("Location: login.php");
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $lineNumber = $_GET["data"];
}

$filename = "./database/users.txt";
$fp = fopen($filename, "r");

if ($fp) {
    $line = false;
    $currentLine = 0;

    while (($currentLine < $lineNumber) && ($line = fgets($fp)) !== false) {
        $currentLine++;
    }

    fclose($fp);
} else {
    echo "Failed to open the file.";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input
    $info = $_POST['info'];
    echo $info;

    $lineNumber = $_GET['data'];

    $filename = "./database/users.txt";
    $fileContents = file($filename);

    if ($fileContents) {
        if ($lineNumber >= 1 && $lineNumber <= count($fileContents)) {
            $fileContents[$lineNumber - 1] = $info . PHP_EOL;
            $fileContents = implode("", $fileContents);

            file_put_contents($filename, $fileContents);
            header("Location: home_admin.php");
        } else {
            echo "The specified line does not exist.";
        }
    } else {
        echo "Failed to open the file.";
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
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
                <center class="mb-3" > <h5>Update Info</h5> </center>
                    <form method="post" action="">

                        <div class="input-group mb-3">
                            <span class="input-group-text" id="basic-addon1">User Info &nbsp; &nbsp; &nbsp; &nbsp;</span>
                            <input type="text" name="info" value="<?php if ($line !== false) { echo $line; } else {echo "The specified line does not exist.";} ?>" class="form-control" placeholder="" aria-label="Username" aria-describedby="basic-addon1">
                        </div>

                        <button type="submit" class="btn btn-primary mt-3 mb-3 mybutton">Updata</button>
                    </form>

                    <div id="result">
                        <?php echo "<center> {$Messages} </center>"; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>