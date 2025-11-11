<?php

require_once 'Conexao.php';

$email = $_POST['email'];
$novaSenha = $_POST['senha'];

if (!empty($email) && !empty($novaSenha)) {

    $checkEmail = $conexao->prepare('SELECT * FROM proprietario WHERE email = :email');
    $checkEmail->bindParam(':email', $email);
    $checkEmail->execute();
    $usuario = $checkEmail->fetch(PDO::FETCH_ASSOC);

    if (!$usuario) {
        echo ' <!DOCTYPE html>
        <html>
        <head>
            <title>Erro</title>
            <link rel="icon" type="image/png" href="../assets/img/favicon.ico">
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <style>* {font-family: Roboto, sans-serif;}</style>
        </head>
        <body>
            <script type="text/javascript">
                Swal.fire({
                    title: "Erro!",
                    text: "E-mail não encontrado.",
                    icon: "error",
                    confirmButtomText: "OK",
                    confirmButtonColor: "#E53935",
                    background: "#BDBDBD",
                    color: "#E53935"
                }).then(function() {
                    location.href = "../view/atualizarSenhaProprietario.html"
                });
            </script>
        </body>
        </html>';
        exit;
    }

    $senhaHash = password_hash($novaSenha, PASSWORD_DEFAULT);
    $sql = 'UPDATE proprietario SET senha = :novaSenha WHERE email = :email';
    
    $requisicao = $conexao->prepare($sql);
    $requisicao->bindParam(':novaSenha', $senhaHash);
    $requisicao->bindParam(':email', $email);

    try {
        $requisicao->execute();
        echo' <!DOCTYPE html>
        <html>
        <head>
            <title>Sucesso</title>
            <link rel="icon" type="image/png" href="../assets/img/favicon.ico">
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <style>* {font-family: Roboto, sans-serif;}</style>
        </head>
            <body>
                <script type="text/javascript">
                    Swal.fire({
                        title: "Senha Alterada",
                        text: "Senha alterada com sucesso!",
                        icon: "success",
                        confirmButtomText: "OK",
                        confirmButtonColor: "#E53935",
                        background: "#BDBDBD",
                        color: "#E53935"
                    }).then(function() {
                         location.href = "../view/atualizarSenhaProprietario.html"
                    });
                </script>
            </body>
        </html>';
    } catch (PDOException $e) {
        echo ' <!DOCTYPE html>
        <html>
        <head>
            <title>Erro</title>
            <link rel="icon" type="image/png" href="../assets/img/favicon.ico">
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <style>* {font-family: Roboto, sans-serif;}</style>
        </head>
        <body>
            <script type="text/javascript">
                Swal.fire({
                title: "Erro!",
                text: "Erro ao alterar senha",
                icon: "error",
                confirmButtomText: "OK",
                confirmButtonColor: "#E53935",
                background: "#BDBDBD",
                color: "#E53935"
                }).then(function() {
                    location.href = "../view/atualizarSenhaProprietario.html"
                });
            </script>
        </body>
    </html>' . $e->getMessage();
    }
} else {
    echo ' <!DOCTYPE html>
    <html>
    <head>
        <title>Erro</title>
        <link rel="icon" type="image/png" href="../assets/img/favicon.ico">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <style>* {font-family: Roboto, sans-serif;}</style>
    </head>
    <body>
        <script type="text/javascript">
              Swal.fire({
            title: "Erro!",
            text: "Preencha todos os campos",
            icon: "error",
            confirmButtomText: "OK",
            confirmButtonColor: "#E53935",
            background: "#BDBDBD",
            color: "#E53935"
        }).then(function() {
            location.href = "../view/atualizarSenhaProprietario.html"
        });
        </script>
    </body>
    </html>';
} 
?>