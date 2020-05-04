<?php
    session_start();

    // DB Access info
    $dbHost = "localhost";
    $dbName = "web_project";
    $dbId = "admin";
    $dbPassword= "yu16969696yu!";

    // writer content info
    $writen_title = $_GET["writen_title"];
    $writen_content = $_GET["writen_content"];
    $writen_date = date("Y-m-d H:i:s");
    $writer = $_SESSION["userName"];

    echo "writer: $writer <br>";
    echo "title: $writen_title <br>";
    echo "conent: $writen_content <br>";
    echo "date: $writen_date <br> <hr>";

    // for Enter recognzie
    $writen_content = nl2br($writen_content);
    
    try{
    $conn = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbId, $dbPassword);
    $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // $stmt = $conn->prepare("INSERT INTO user_info(user_name, user_id, user_password, user_contry) VALUES(:userName, :userID, :userPassword, :userContry) ");

    $stmt = $conn->prepare("INSERT INTO user_board(btitle, contents, bdate, bwriter) VALUES(:writen_title, :writen_content, :writen_date, :writer)");

    // $stmt -> bindValue(":userName", $name);
    $stmt -> bindValue(":writen_title", $writen_title);
    $stmt -> bindValue(":writen_content", $writen_content);
    $stmt -> bindValue(":writen_date", $writen_date);
    $stmt -> bindValue(":writer", $writer);

    $stmt -> execute();
    $result = $stmt -> fetch();

    echo $result;
    }
    catch(Exception $e){

    }finally{
        header("Location: main_board.php");
    }

?>