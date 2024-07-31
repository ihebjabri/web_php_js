<?php

include 'db_connexion.php'; 


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $classroom = $_POST['classroom'];
    $birthday = $_POST['birthday'];

   
    
    if (empty($firstName) || empty($lastName) || empty($classroom) || empty($birthday)) {
        echo "All fields are required.";
        exit;
    }


    try {
        $stmt = $pdo->prepare("INSERT INTO students (first_name, last_name, classroom, birthday) VALUES (:first_name, :last_name, :classroom, :birthday)");
        $stmt->bindParam(':first_name', $firstName);
        $stmt->bindParam(':last_name', $lastName);
        $stmt->bindParam(':classroom', $classroom);
        $stmt->bindParam(':birthday', $birthday);
        $stmt->execute();
        header("Location: ../index.php");
        echo "Student added successfully.";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}