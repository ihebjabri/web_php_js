<?php
include 'db_connexion.php'; 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $classroom = $_POST['classroom'];
    $birthday = $_POST['birthday'];
    $status =  $_POST['status'];

    if (empty($id) || empty($firstName) || empty($lastName) || empty($classroom) || empty($birthday) || empty($status)) {
        echo "Tous les champs sont obligatoires.";
        exit;
    }

    try {
        $stmt = $pdo->prepare("UPDATE students SET first_name = :first_name, last_name = :last_name, classroom = :classroom, birthday = :birthday, status =:status WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':first_name', $firstName);
        $stmt->bindParam(':last_name', $lastName);
        $stmt->bindParam(':classroom', $classroom);
        $stmt->bindParam(':birthday', $birthday);
        $stmt->bindParam(':status', $status);
        $stmt->execute();

        header("Location: ../index.php");
        exit;
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
} else {
    echo "Requête invalide.";
}