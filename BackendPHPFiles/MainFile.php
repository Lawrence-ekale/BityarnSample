<?php
header("Access-Control-Allow-Origin: http://localhost:5173");//to be changed according to my front-end

// Include the database configuration file
include 'MyConfigdb.php';
include 'Registration.php';

// Create a new PDO object
try {
    $db = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set PDO error mode to exception
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}



if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['level'])){
    $level = htmlspecialchars(strip_tags($_POST['name']));
    $location = new Registration($db);
    $response = $location->getAll($level);;
    if(count($response) >= 0) {
        $response = array(
            'status' => 'success',
            'message' => 'true',
            'payload' => $response
        );
    }
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}else if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['sub_level_to_view'])){
    $level = htmlspecialchars(strip_tags($_POST['level1']));
    $sub_level = htmlspecialchars(strip_tags($_POST['sub_level_to_view']));
    $id = htmlspecialchars(strip_tags($_POST['id']));
    $levelSend = 0;
    $sub_levelSend = 0;
    if($level == 'Country') {
        $levelSend = 1;
    } else if($level == 'County') {
        $levelSend = 2;
    } else if($level == 'Sub_County') {
        $levelSend = 3;
    } else if($level == 'Ward') {
        $levelSend = 4;
    } else {
        $levelSend = 5;
    }

    if($sub_level == 'View Country') {
        $sub_levelSend = 1;
    } else if($sub_level == 'View County') {
        $sub_levelSend = 2;
    } else if($sub_level == 'View Sub-County') {
        $sub_levelSend = 3;
    } else if($sub_level == 'View Ward') {
        $sub_levelSend = 4;
    } else {
        $sub_levelSend = 5;
    }
    $location = new Registration($db);
    $response = $location->getSubLevelAll($levelSend,$id,$sub_levelSend);;
    if(count($response) >= 0) {
        $response = array(
            'status' => 'success',
            'message' => 'true',
            'payload' => $response
        );
    }
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}   


?>