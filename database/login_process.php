<?php
include 'db_connexion.php'; 

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

 
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
 
        $sql = "SELECT * FROM users WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

       
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

 
        if ($user && $password === $user['password']) {
          
            $_SESSION['loggedin'] = true;
            $_SESSION['user_id'] = $user['id'];  
            $_SESSION['email'] = $user['email'];
            
           
            header("Location: ../index.php");
            exit();
        } else {
         
            header("Location: ../login.php?error=1");
            exit();
        }
    } catch (PDOException $e) {
       
        error_log("Database error: " . $e->getMessage());
        echo "An error occurred. Please try again later.";
    }
}
?>