<?php
    session_start();

    if(isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['senha'])){

        include_once('config.php');
        $email =$_POST['email'];
        $senha =$_POST['senha'];

        $query = "SELECT * FROM tbl_usuarios WHERE email = '$email' and senha = '$senha';";
        $result = mysqli_query($conexao, $query);
        if($result->num_rows > 0){
            $row = $result->fetch_assoc();
            $nome = $row['nome'];
            $admin = $row['admin'];
        }

        if(mysqli_num_rows($result) < 1){
            unset($_SESSION['email']);
            unset($_SESSION['senha']);
            unset($_SESSION['nome']);
            unset($_SESSION['admin']);
            header('Location: login.php');
        }else{
            $_SESSION['email'] = $email;
            $_SESSION['senha'] = $senha;
            $_SESSION['nome'] = $nome;
            $_SESSION['admin'] = $admin;
            header('Location: listagem.php');
        }

    }else{
        header('Location: login.php');
    }
?>