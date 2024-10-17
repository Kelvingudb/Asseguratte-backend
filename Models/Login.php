<?php
require 'db_connection.php';  

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

   
    $stmt = $pdo->prepare("SELECT * FROM superuser WHERE Name_user = :username");
    $stmt->execute(['username' => $username]);


    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        if (isset($user['Passwd_user']))
        {
         $verify = password_verify($password, $user['Passwd_user']);
        
         if($verify) {
            echo "Inicio de sesión exitoso";
            session_start();
            $_SESSION['user'] = $user;
            exit(); 
        } else {
            echo "Contraseña incorrecta";
        }
        } 
    }   
    else {
    echo "El usuario no existe";
}
}
?>
