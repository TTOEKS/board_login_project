<!DOCTYPE html>
<html>
<head>
    <title>게시판</title>
    <meta charset="UTF-8">
    <style>
        tr{
            align : "center";
        }
    </style>

</head>

<body>  
<header>
    <h1> 게시판 </h1>

</header>

    <?php
        session_start();
        $name = $_SESSION["userName"];
        $id = session_id();
        $dbHost = "localhost";
        $dbName = "dbname";
        $dbId = "dbid";
        $dbPassword= "dbpassword";


        echo ("안녕하세요 $name 님! <br>");
        echo ("Seesion Info: Session ID: $id <br>");

        // Connect Database
        $conn = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbId, $dbPassword);
        $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    ?>
    <hr>
    <form action="write.php" method="POST">
        <input type="submit" value="글 쓰기">
    </form>


    <?php
        // Board Count
        $stmt1 = $conn->prepare("SELECT COUNT(*) FROM user_board");
        $stmt1 -> execute();
        $board_count = $stmt1->fetch()[0];

        echo "board_count = $board_count <br>";

        // Load Board Contents
        $stmt2 = $conn->prepare("SELECT bidx, btitle, bwriter, bdate, hits, recommend FROM user_board ORDER BY bidx ASC ");
        $stmt2 -> execute();
        $board_present = $stmt2 ->fetchAll();

        // Make Board Function
        if($board_count == 0){
            echo "등록된 게시글이 없습니다.";
        }
        else{
           echo '
            <table border=1> 
                <tr align="center">
                <td>번호</td>
                <td>제목</td>
                <td>작성자</td>
                <td>등록일</td>
                <td>조회수</td>
                <td>추천순</td>
                </tr>
            ';
        
            for($i=0; $i<$board_count; $i++){
                echo '<tr align="center">';
                for($j=0 ;$j<6; $j++){
                    
                    // TItle part adjust a tag
                    if($j == 1){?>
                    <td> <a href="view.php?idx=<?php echo $board_present[$i][0]?>">
                    <?php echo $board_present[$i][$j] ?> 
                    </a>
                    <?php    
                    continue;
                    }else {
                    ?>

                    <td> <?php echo $board_present[$i][$j] ?> </td>
                    <?php
                    }
                }

                echo "</tr>";
                }
            
                echo"</table>";
            }         
    ?>

</body>

</html>
