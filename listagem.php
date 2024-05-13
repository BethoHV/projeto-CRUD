<?php
    session_start();
    include_once('config.php');

    if((!isset($_SESSION['email']) == true) && (!isset($_SESSION['senha']) == true)){
        unset($_SESSION['email']);
        unset($_SESSION['senha']);
        header('Location: login.php');
    }

    $logado = $_SESSION['nome'];
    $admin = $_SESSION['admin'];


    $sql = "SELECT * FROM tbl_usuarios ORDER BY id DESC;";
    $result = $conexao->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles\style-listagem.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <title>Listagem Usuarios</title>
    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
            background-image: linear-gradient(to left, rgb(252, 252, 252), rgb(0, 0, 0));
        }
        table{
            background-color: rgba(0, 0, 0, 0.6);;
            border-radius: 15px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: rgb(0, 66, 133, 89%);">
        <div class="container" style="display: block">
            <a class="navbar-brand" href="#">Listagem</a>
            <?php if($admin == 1 ){?>
                <a href="form.php" class="btn btn-light me-5">Adicionar usuario</a>
            <?php }?>
        </div>
        <div class="d-flex">
            <h1 class="navbar-brand" href="#">Bem vindo <?=$logado ?></h1>
            <a href="sair.php" class="btn btn-danger me-5">Sair</a>
        </div>
    </nav>
    <div class="m-5">
        <table class="table text-white table-bg">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Email</th>
                    <th scope="col">Telefone</th>
                    <th scope="col">Gênero</th>
                    <th scope="col">Data de Nascimento</th>
                    <th scope="col">Cidade</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Endereço</th>
                    <?php if($admin == 1 ){?>
                        <th scope="col">...</th>
                    <?php }?>
                </tr>
            </thead>
            <tbody>
                <?php
                    while($user_data = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>".$user_data['id']."</td>";
                        echo "<td>".$user_data['nome']."</td>";
                        echo "<td>".$user_data['email']."</td>";
                        echo "<td>".$user_data['telefone']."</td>";
                        echo "<td>".$user_data['genero']."</td>";
                        echo "<td>".$user_data['data_nascimento']."</td>";
                        echo "<td>".$user_data['cidade']."</td>";
                        echo "<td>".$user_data['estado']."</td>";
                        echo "<td>".$user_data['endereco']."</td>";
                        if($admin == 1 ){
                            echo "<td>
                            <a class='btn btn-sm btn-primary' href='form.php?id=$user_data[id]'><i class='fa fa-pencil' aria-hidden='true'></i></a> 
                            <a class='btn btn-sm btn-danger' href='delete.php?id=$user_data[id]' title='Deletar'><i class='fa fa-trash' aria-hidden='true'></i></a>
                            </td>";
                        }
                        echo "</tr>";
                    }
                    ?>
            </tbody>
        </table>
    </div>
</body>
</html>