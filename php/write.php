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
    <form action="write_process.php" method="GET">
        <table>
            <tr>
                <td>작성자   </td>
                <td> <?=$name?>
            </tr>
            <tr>
                <td>제목 </td>
                <td>
                    <input type="text" name="writen_title">
                </td>
            </tr>
            <tr>
                <td>내용 </td>
                <td>
                    <textarea name="writen_content" cols=85 rows=15></textarea>
                </td>
            </tr>
        </table>
        <input type="submit" value="글 작성">
        <input type="reset" value="초기화">
        <input type="button" value="뒤로 가기" formaction="main_board.php">
    </form>
</body>

</html>