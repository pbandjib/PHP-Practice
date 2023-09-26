
<?php
    function esc($str) {
        return htmlspecialchars($str);
    }

    $test = 'This is a mother fucking test';
    $title = 'PHP Practice';

    $servername = 'localhost';
    $username = 'root';
    $password = '';
    $dbname = 'php_practice';

    $connection = new mysqli($servername, $username, $password, $dbname);

//    Check connection
    if ($connection->connect_error) {
        die("Construction Failed: " . $connection->connect_error);
    }

//    Check for POST request
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
            print_r($_POST);

            $name = $_POST['name'];
//            Validate Name
            if (!is_string($name) || empty($name)) {
                echo "Invalid name";
                exit;
            }
            if (strlen($name) > 50){
                echo "Name is too long";
                exit;
            }

            $age = $_POST['age'];
//        Validate Age
            if(!filter_var($age, FILTER_VALIDATE_INT) || $age < 0){
                echo "Invalid Age";
                exit;
            }

            $owner_id = $_POST['owner_id'];
//            Validate Owner
            if(!filter_var($owner_id, FILTER_VALIDATE_INT) || $owner_id < 0){
                echo "Invalid Owner ID";
                exit;
            }


//          Not allow SQL injection
            $statement = $connection->prepare("INSERT INTO cats (name, age, owner_id) VALUES (?, ?, ?)");
            $statement->bind_param('sii', $name, $age, $owner_id);

            if($statement->execute() === TRUE){
                echo "New record created successfully";
            }else{
                echo "Error: " . $statement->error;
            }

            $statement->close();
        }

//    Select all from cats in DB
    $sql = "SELECT * FROM cats";
    $result = $connection->query($sql);
    $cats = [];

    if ($result->num_rows == 0) {
        echo "No Cats Found";
    }

    while($row = $result->fetch_assoc()){
        $cats[] = $row;
    }

    $connection->close();


    ?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $title; ?></title>
</head>
<body>
<h1><?= $test ?></h1>
