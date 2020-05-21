<!DOCTYPE html>
<html>
<head>

<?php
    session_start();
    $name = $_SESSION["userName"];
    $index = $_GET['idx'];

    // Prevent bad Session 
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
    $writer = $boardValues[5];

    // for Enter recognzie
    $contents = nl2br($contents);
    
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
    <a href="main_board.php"><h1> 게시판 </h1></a>

    <div class="board_form">
        <h3> <?php echo $title; ?> </h3> 
        <p> 글번호 <?php echo $index ?> | <?php echo $date; ?> </p>
        <hr>
        <h5> 작성자:  <?php echo $writer ?> </h5>
        <br>

        <p id = "main_contents">
            <?php echo $contents ?>

        </p>

        <p>
            조회수 <?php echo $update_hits; 
            
            // Delete function
            if($name == $writer){
                echo' | 
                   <button type="button" onClick="location.href=\'func/deleteFunc.php?idx='; echo $index; 
                   echo '\'">
                   삭제
                   </button>
                    ';

                    echo' | 
                    <button type="button" onClick="location.href=\'func/modifyFunc.php?idx='; echo $index; 
                    echo '\'">
                    수정
                    </button>
                     ';
            }
            ?> 
        </p>


    <div>
</body>
</html>


