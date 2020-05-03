<!DOCTYPE html>
<html>
<head>

<?php
    session_start();
    $name = $_SESSION["userName"];
    $index = $_GET['idx'];

    if($name == Null|| $name==""){
        echo '<script> alert("세션이 만료되었거나, 불건전한 접근입니다."); </script>';
        location.replace("login.html");
    }
    // DB info
    $dbHost = "localhost";
    $dbName = "web_project";
    $dbUser = "admin";
    $dbPassword = "yu16969696yu!";

    try{
    // Connect database
    $conn = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPassword);
    $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    // make query
    $stmt = $conn -> prepare("SELECT * FROM user_board WHERE bidx=:index");
    $stmt -> bindValue(":index", $index);
    $stmt -> execute();

    $boardValues = $stmt->fetch();

    // check load data
    if($boardValues == 0 || $boardValues == Null){
        echo '<script> alert("Failed to load database!!"); 
        location.replace("main_board.php");
        </script>        ';
    }

    // set values
    $index = $boardValues[0];
    $title = $boardValues[1];
    $contents = $boardValues[2];
    $date = $boardValues[3];
    $update_hits = $boardValues[4] + 1;
    $recommends = $boardValues[5];
    $writer = $boardValues[6];
    
    // Update hits
    $update_stmt = $conn -> prepare("UPDATE user_board SET hits=:update_hits WHERE bidx=:index");
    $update_stmt ->bindValue(":update_hits", $update_hits);
    $update_stmt ->bindValue(":index", $index);
    $update_stmt ->execute();


    } catch(Exception $e){
        echo "Errro occurr! <br> Error info";
        echo $e;
    }

?>
<title> <?php echo $title ?> </title>
<meta charset="UTF8">
<style>
    .board_form{
       
   }

</style>

</head>

<body>
    <div class="board_form">
        <h3> <?php echo $title; ?> </h3> 
        <p> 글번호 <?php echo $index ?> | <?php echo $date; ?> </p>
        <hr>
        <h5> 작성자:  <?php echo $writer ?> </h5>
        <br>

        <p>
            <?php echo $contents ?>

        </p>

        <p>
            조회수 <?php echo $update_hits ?> | 추천수 <?php echo $recommends?>
        </p>


    <div>
</body>
</html>


