<?php

include 'config.php';
session_start();
$user_id =  $_SESSION['user_id'];

if(!isset($user_id)){
    header('location:login.php');
};

if(isset($_GET['logout'])){
    unset($user_id);
    session_destroy();
    header('location:login.php');
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>students list</title>
    <link rel="stylesheet" href="">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css?fbclid=IwAR0XUJU03vLwqBWQlVsu_CCvCGRM8o4AGe7hlceBayAsyFi9IRYyh90EceY">

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand fw-bold" style="color: yellow;" href="#">SCHOOL</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav m-auto mb-2 mb-lg-0">
                    
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About</a>
                    </li>
                </ul>
                </form>
            </div>
        </div>
    </nav>
    <div class="container">
       <h2>List of students</h2>
       <a class="btn btn-primary" href="/dbphp/update.php" role="button">New Students</a>
       <a class="btn btn-primary" href="/dbphp/search.php" role="button">Search</a>
       <br>
       <br>
       <br>    
                   
                    
       <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $servername = "localhost";
                $username = "root";
                $password = "";
                $database = "user_db";

                   $connection = new mysqli($servername, $username, $password, $database);

                if ($connection->connect_error){
                    die("connection failed: " . $connection->connect_error);
                }
                $sql = "SELECT * FROM students";
                $result = $connection->query($sql);
                $num=mysqli_num_rows($result);
                $numberPages=4;
                $totalPages=ceil($num/$numberPages);
                //echo $totalPages;

                for($btn=1;$btn<=$totalPages;$btn++){
                    echo '<button class="btn btn-dark mx-1 mb-3"><a href="home.php?page='.$btn.'" class="text-light">'.$btn.'</a></button>';
                }
                if(isset($_GET['page'])){
                    $page=$_GET['page'];
                    //echo $page;
                }else
                {
                    $page=1;
                }
                //1------> 0,5
               // 2------> 5,5
                //3------> 10,5
               // (pnum-1)*$numberPages

               $startinglimit=($page-1)*$numberPages;
               $sql = "SELECT * FROM students LIMIT " .$startinglimit.
               ','.$numberPages;
               $result=mysqli_query($conn,$sql);


                if(!$result){
                    die("invalid query: " . $connection->error);
                }

                while($row = $result->fetch_assoc()){
                    echo "
                <tr>
                    <td>$row[id]</td>
                    <td>$row[name]</td>
                    <td>$row[email]</td>
                    <td>$row[phone]</td>
                    <td>$row[address]</td>
                    <td>
                        <a class='btn btn-primary btn-sm' href='/dbphp/edit.php?id=$row[id]'>Edit</a>
                        <a class='btn btn-danger btn-sm' href='/dbphp/delete.php?id=$row[id]'>delete</a>
                    </td>
                </tr>
                
                ";
                }
                ?>

            </tbody>
       </table>
    </div>
    <div class="container">
    <p dir="rtl"><a class="btn btn-primary" href="/dbphp/updates_account.php" role="button">Update profile</a></p>
    <p dir="rtl"><a class="btn btn-danger" href="/dbphp/login.php" role="button">Logout</a></p>       
    </div>
</body>
</html>