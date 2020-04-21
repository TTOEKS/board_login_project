<!DOCTYPE html>
<html>
<head>
    <title>게시판</title>
    <meta charset="UTF-8">

</head>

<body>  
    <?php
        session_start();
        $name = $_SESSION["userName"];
        $id = session_id();

        echo ("안녕하세요 $name 님! <br>");
        echo ("Seesion Info: Session ID: $id")
    ?>

</body>

</html>