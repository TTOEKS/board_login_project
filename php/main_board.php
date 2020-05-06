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
<!--
    compute limit range 
        page 1 -> (1 - 1) * 10 = 0,  1 * 10 = 10
        page 2 -> (2 - 1) * 10 = 10, 2 * 10 = 20
        page 3 -> (3 - 1) * 10 = 20, 3 * 10 = 30
  -->

    <?php
        session_start();
        $name = $_SESSION["userName"];

       
        // default of page_num is 1
        if(isset($_GET["idx"])){
            if(!$page_num = $_GET["idx"]){
                $page_num = 1;
            }
        }else{
            $page_num=1;
        }

        // DB info
        $dbHost = "localhost";
        $dbName = "dbname";
        $dbUser = "dbuser";
        $dbPassword = "dbpassword";


        echo ("안녕하세요 $name 님! <br>");

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

        // Load Board Contents and Paging
        $page_start = ($page_num-1) * 10;
        $page_end = $page_num * 10;
        $stmt2 = $conn->prepare("SELECT bidx, btitle, bwriter, bdate, hits FROM user_board ORDER BY bidx DESC LIMIT $page_start, $page_end");
        $stmt2 -> execute();
        $board_present = $stmt2 ->fetchAll();

        // Make Board Function
        if($board_count == 0){
            echo "등록된 게시글이 없습니다.";
        }
        else{
            if(sizeof($board_present) == 0){
                header("Location:main_board.php?idx=1");
            }else{
            echo '
                <table border=1> 
                    <tr align="center">
                    <td>번호</td>
                    <td>제목</td>
                    <td>작성자</td>
                    <td>등록일</td>
                    <td>조회수</td>
                    </tr>
                ';
                
                // Display Board info
                for($i=0; $i<sizeof($board_present); $i++){
                    echo '<tr align="center">';
                    for($j=0 ;$j<5; $j++){
                        
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
            }         
    ?>
    
    <div id="page">
        
    </div>

    <script>
            // number of page
            let num_page = Math.floor(<?php echo $board_count;?>/10),
                doc_page = document.getElementById("page");            

            // Display and Set a Tag
            result = '';
            for(var i=1; i<=num_page+1; i++){
                result += `<a href=\"main_board.php?idx=${i}\"> [${i}] </a> `;
            }
            doc_page.innerHTML = result;
        </script>

</body>

</html>
