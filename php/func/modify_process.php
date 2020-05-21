<?php
    $index =    $_GET["idx"];
    $title =    $_POST["modified_title"];
    $contents = $_POST["modified_contents"];
    $date = date("Y-m-d H:i:s");

    session_start();
    $name = $_SESSION["userName"];

    // DB info
    $dbHost = "localhost";
    $dbName = "dbname";
    $dbId = "id";
    $dbPassword= "password";
  
      try{
      // Connect database
      $conn = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPassword);
      $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $update_stmt = $conn -> prepare("UPDATE user_board SET btitle=:title, contents=:contents, bdate=:mdate WHERE bidx=:idx");
      $update_stmt -> bindValue("title", $title);
      $update_stmt -> bindValue("contents", $contents);
      $update_stmt -> bindValue("mdate", $date);
      $update_stmt -> bindValue("idx", $index);

      if($update_stmt ->execute()){
          echo "
          <script> 
          alert('게시글 변경에 성공했습니다'); 
          </script>
          ";
          
      }else{
        echo "
        <script> 
        alert('게시글 변경에 실패했습니다'); 
        header('Location:view.php?idx=$index');
        </script>
        ";
      }


      } catch (Excepteion $e){
          echo $e;
      }

?>
<meta http-equiv="refresh" content="0 url=../view.php?idx=<?php echo $index; ?>">
