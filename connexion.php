<?php
session_start();

    if(isset($_POST['connexion'])){
        $email = $_POST['email'];
        $password = $_POST['password'];

        $db = new PDO('mysql:host=localhost;dbname=TpEcommerce', "root", "");

        $sql = "SELECT * FROM client WHERE email = '$email'";
        $result = $db->prepare($sql);
        $result->execute([
            "email" => $email
        ]);

        if($result->rowCount() > 0){
            $data = $result->fetchAll();
            if(password_verify($password, $data[0]["password"])){
                $_SESSION["email"] = $email;
                $_SESSION["client"] = $data[0]["idClient"];
                header('location: compte.php');
            } else{
                echo "Mauvais email ou mot de passe !";
            }
        }
    }
?>