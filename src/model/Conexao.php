<?php

$host = "localhost";
$usuario = "root";
$senha = "Jd&jl2104";
$nomeBanco = "trackItAdm";
    

try{
    $conexao = new PDO(
        "mysql:host=$host;
        dbname=$nomeBanco;charset=UTF8",
        $usuario,
        $senha
    );  

    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}catch(PDOException $e){
    echo "ERRO: " . $e->getMessage();
}

?>