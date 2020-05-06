<?php
    
    $index = $_GET['idx'];

    // DB info
    $dbHost = "localhost";
    $dbName = "dbname";
    $dbUser = "dbuser";
    $dbPassword = "dbpassword";

    try{
        // Connect database
        $conn = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPassword);
        $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn ->prepare("DELETE FROM user_board WHERE bidx=:index");
        $stmt ->bindValue(":index", $index);
        $stmt->execute();

        echo "
        <script> 
        alert('성공적으로 삭제되었습니다!'); 
        window.location.href = '../main_board.php';
        </script>
        ";
        
    } catch(Exception $e){
        echo $e;
    }
?>
