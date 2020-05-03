<html>
<head>
    <meta charset="utf8">

</head>
<body>


<?php
       $dbHost = "localhost";
       $dbName = "dbname";
       $dbUser = "dbuser";
       $dbPassword = "dbpassword!";

       $input_id = $_POST["userID"];
       $input_password = $_POST["userPassword"];



       try{
//     $conn = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPassword);
            $conn = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPassword);
            $conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            // $stmt = $conn->prepare("SELECT user_name FROM user_info WHERE user_id=:userid AND user_password=:userpassword");
            $stmt = $conn->prepare("SELECT user_name FROM user_info WHERE user_id=:userid and user_password=:userpassword");
            $stmt ->bindValue(":userid", $input_id);
            $stmt ->bindValue(":userpassword", $input_password);

            $stmt -> execute();
            $row= $stmt->fetch();

            // check user data exist in database
            if($row == ""){
                echo '
                <script> 
                    alert("아이디 혹은 비밀번호가 다릅니다.") 
                    location.replace("login.html");
                </script>';
             
            }else{
                session_start();
                $_SESSION["userName"] = $row[0];
                
                header("Location: main_board.php");
            }
           
            

        } catch(PDOException  $e){
            $s = "Fail to Read Driver! <br> Error Code: ".  $e -> getCode() . "Error Message: ".$e->getMessage();
            echo $s;
    
        } catch(Exception $e){
            $s = "Exception ". $e->getMessage(). " Error Code: ". $e->getCode();
            echo $s."<br>";
    
            echo $e;
        } finally{
        
        }



?>
</body>
</html>
