<?php
    // userName, userPassword, userPasswordConfirm, userContry
    $name = $_POST["userName"];
    $id = $_POST["userID"];
    $password = $_POST["userPassword"];
    $password_confrom = $_POST["userPasswordConfirm"];
    $contry = $_POST["userContry"];

    // DB info
    $dbHost = "localhost";
    $dbName = "web_project";
    $dbUser = "admin";
    $dbPassword = "yu16969696yu!";

    try{

    // Connect DB
    $conn = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPassword);
    $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("INSERT INTO user_info(user_name, user_id, user_password, user_contry) VALUES(:userName, :userID, :userPassword, :userContry) ");
    $stmt -> bindValue(":userName", $name);
    $stmt -> bindValue(":userID", $id);
    $stmt -> bindValue(":userPassword", $password);
    $stmt -> bindValue(":userContry", $contry);

    $stmt -> execute();
    $result = $stmt -> fetch();
    
    echo $result;

    } catch(PDOException  $e){
        $s = "Fail to Read Driver! <br> Error Code: ".  $e -> getCode() . "Error Message: ".$e->getMessage();
        echo $s;

    } catch(Exception $e){
        $s = "Exception ". $e->getMessage(). " Error Code: ". $e->getCode();
        echo $s."<br>";

        echo $e;
    } finally{
        header("Location: ../login.html");
    }
?>