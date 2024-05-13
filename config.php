<?php

    $dbHost = 'localhost';
    $dbUsername = 'root';
    $dnPassword = '';
    $dbNmae = 'focel';

    $conexao = new mysqli($dbHost,$dbUsername,$dnPassword,$dbNmae);

    // if($conexao->connect_errno){
    //     echo "Erro na conexão";
    // }else{
    //     echo "Conexão estabelecida!";
    // }

?>
