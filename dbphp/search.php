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
                        <a class="nav-link" href="about.html">About</a>
                    </li>
                </ul>
                </form>
            </div>
        </div>
    </nav>
    <div class="container">
       <h2>List of students</h2>
       <br>
       <br>
                    <div class="container my-1">
                         <form method="post">
                         <input type="text" placeholder="Search data" name="search">
                         <button class="btn btn-primary btn-sm" name="submit">Search</button>
                         </form>
                         <div class="container my-5">
                                <table class="table">
                                    <?php
                                    if(isset($_POST['submit'])){
                                        $search=$_POST['search'];

                                        $sql=" SELECT * FROM students WHERE id='$search'
                                         OR name='$search'";
                                        $result=mysqli_query($conn,$sql);
                                        if($result){
                                           if(mysqli_num_rows($result)>0){
                                            echo '<thead>
                                            <tr>
                                            <th>Id</th>
                                            <th>First Name</th>
                                            <th>Email</th>
                                            <th>phone</th>
                                            <th>address</th>
                                            </tr>
                                            </thead>
                                            ';
                                            $row=mysqli_fetch_assoc($result);
                                            echo '<tbody>
                                            <tr>
                                            
                                            <td>'.$row['id'].'</td>
                                            <td>'.$row['name'].'</td>
                                            <td>'.$row['email'].'</td>
                                            <td>'.$row['phone'].'</td>
                                            <td>'.$row['address'].'</td>

                                            </tr>
                                            </tbody>';

                                           }else{
                                            echo '<h2 class=text-danger>Data not found</h2>';
                                           }
                                        }
                                    }
                                    ?>
                                    
                                
                                    

                                </table>
                         </div>
                    </div>
       <br>
                    
       <table class="table">
            
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

                if(!$result){
                    die("invalid query: " . $connection->error);
                }

                while($row = $result->fetch_assoc()){
                    echo "
               
                
                ";
                }
                ?>

            </tbody>
       </table>
    </div>
    <div class="container">
    <p dir="rtl"><a class="btn btn-primary" href="/dbphp/home.php" role="button">Home</a></p>
         
    </div>
</body>
</html>