<?php 
   include_once('config.php');

    if(isset($_POST['submit'])){
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $telefone = $_POST['telefone'];
        $genero = $_POST['genero'];
        $data_nascimento = $_POST['data_nascimento'];
        $cidade = $_POST['cidade'];
        $estado = $_POST['estado'];
        $endereco = $_POST['endereco'];

        $query = "INSERT INTO tbl_usuarios (nome,email,senha,telefone,genero,data_nascimento,cidade,estado,endereco) 
        VALUES ('$nome','$email','$senha','$telefone','$genero','$data_nascimento','$cidade','$estado','$endereco');";
        $result = mysqli_query($conexao, $query);
        header('Location: listagem.php');

    }elseif(isset($_POST['update'])){
        $id = $_POST['id'];
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $telefone = $_POST['telefone'];
        $genero = $_POST['genero'];
        $data_nascimento = $_POST['data_nascimento'];
        $cidade = $_POST['cidade'];
        $estado = $_POST['estado'];
        $endereco = $_POST['endereco'];
        
        $sqlInsert = "UPDATE tbl_usuarios 
        SET nome='$nome',senha='$senha',email='$email',telefone='$telefone',genero='$genero',data_nascimento='$data_nascimento',cidade='$cidade',estado='$estado',endereco='$endereco'
        WHERE id=$id";
        $result = $conexao->query($sqlInsert);
        header('Location: listagem.php');
    }

    if(!empty($_GET['id'])){

        $id = $_GET['id'];
        $sqlSelect = "SELECT * FROM tbl_usuarios WHERE id=$id";
        $result = $conexao->query($sqlSelect);
        if($result->num_rows > 0){
            while($user_data = mysqli_fetch_assoc($result)){
                $nome = $user_data['nome'];
                $senha = $user_data['senha'];
                $email = $user_data['email'];
                $telefone = $user_data['telefone'];
                $genero = $user_data['genero'];
                $data_nascimento = $user_data['data_nascimento'];
                $cidade = $user_data['cidade'];
                $estado = $user_data['estado'];
                $endereco = $user_data['endereco'];
            }
        }else{
            header('Location: listagem.php');
        }
    }

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles\style-form.css">
    <title>Formulário</title>
</head>
<body>
    <div class="box">
        <form action="form.php" method="POST">
               <div><b>Fórmulário de Registro</b></div>
                <br>
                <div class="inputBox">
                    <input type="text" name="nome" id="nome" class="inputUser" required value=<?php if(!empty($id)){echo $nome;}?>>
                    <label for="nome" class="labelInput">Nome completo</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="email" id="email" class="inputUser" required value=<?php if(!empty($id)){echo $email;}?>>
                    <label for="email" class="labelInput">Email</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="password" name="senha" id="senha" class="inputUser" required value=<?php if(!empty($id)){echo $senha;}?>>
                    <label for="senha" class="labelInput">Senha</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="tel" name="telefone" id="telefone" class="inputUser" required value=<?php if(!empty($id)){echo $telefone;}?>>
                    <label for="telefone" class="labelInput">Telefone</label>
                </div>
                <p>Sexo:</p>
                <input type="radio" id="feminino" name="genero" value="feminino" required <?php if(!empty($id) AND $genero == 'feminino'){echo 'checked';}?>>
                <label for="feminino">Feminino</label>
                <br>
                <input type="radio" id="masculino" name="genero" value="masculino" required <?php if(!empty($id) AND $genero == 'masculino'){echo 'checked';}?>>
                <label for="masculino">Masculino</label>
                <br>
                <input type="radio" id="outro" name="genero" value="outro" required <?php if(!empty($id) AND $genero == 'outro'){echo 'checked';}?>>
                <label for="outro">Outro</label>
                <br><br>
                <label for="data_nascimento"><b>Data de Nascimento:</b></label>
                <input type="date" name="data_nascimento" id="data_nascimento" required value=<?php if(!empty($id)){echo $data_nascimento;}?>>
                <br><br><br>
                <div class="inputBox">
                    <input type="text" name="cidade" id="cidade" class="inputUser" value=<?php if(!empty($id)){echo $cidade;}?>>
                    <label for="cidade" class="labelInput">Cidade</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="estado" id="estado" class="inputUser" value=<?php if(!empty($id)){echo $estado;}?>>
                    <label for="estado" class="labelInput">Estado</label>
                </div>
                <br><br>
                <div class="inputBox">
                    <input type="text" name="endereco" id="endereco" class="inputUser" value=<?php if(!empty($id)){echo $endereco;}?>>
                    <label for="endereco" class="labelInput">Endereço</label>
                </div>
                <br><br>
                <input type="hidden" name="id" value=<?php if(!empty($id)){echo $id;}?>>
                <?php if(!empty($id)){ ?>
                    <input type="submit" name="update" id="submit">
                 <?php }else{ ?>
                    <input type="submit" name="submit" id="submit">
                 <?php } ?>
        </form>
    </div>
</body>
</html>