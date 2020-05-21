<?php
    
    $index = $_GET['idx'];

    // DB info
    $dbHost = "localhost";
    $dbName = "dbname";
    $dbId = "id";
    $dbPassword= "password";

    try{
        // Connect database
        $conn = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPassword);
        $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $conn ->prepare("SELECT btitle, contents FROM user_board WHERE bidx=:index");
        $stmt ->bindValue(":index", $index);
        $stmt ->execute();

        $boardValues = $stmt ->fetch();
        $title = $boardValues[0];
        $contents = $boardValues[1];

        
        
    } catch(Exception $e){
        echo $e;
    }
?>
<!DOCTYPE html>
<html>
<head>
<?php 
    session_start();
    $name = $_SESSION["userName"];?>
</head>
<body>
    <script>
        val userName = <?=$name?>;
    if( userName == null || userName == ""){
        alert("세션 오류가 발생했습니다"); 
          header("Location: main_board.php");
    }
    </script>
    <h1> 글쓰기 </h1>
    <hr>

    <!-- To hand index value -->
    <form action="modify_process.php?idx=<?php echo $index?>" method="POST">
        <table>
            <tr>
                <td>작성자   </td>
                <td> <?=$name?>
            </tr>
            <tr>
                <td>제목 </td>
                <td>
                    <input type="text" name="modified_title" value=<?php echo $title;?> >
                </td>
            </tr>
            <tr>
                <td>내용 </td>
                <td>
                    <textarea name="modified_contents" cols=85 rows=15> <?php echo $contents;?></textarea>
                </td>
            </tr>
        </table>
        <input type="submit" value="글 수정">
        <input type="reset" value="초기화">
        <input type="button" value="뒤로 가기" formaction="main_board.php">
    </form>
</body>
</html>
