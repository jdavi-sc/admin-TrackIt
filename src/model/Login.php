<?php
session_start();
require_once 'Conexao.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = $_POST["userEmailLogin"] ?? '';
    $senha = $_POST["userSenhaLogin"] ?? '';
    $codigo = $_POST["codigoVerificacao"] ?? '';

    if (empty($email) || empty($senha) || empty($codigo)) {
        echo '<!DOCTYPE html>
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
                    title: "Campos vazios!",
                    text: "Por favor, preencha todos os campos antes de continuar.",
                    icon: "warning",
                    confirmButtonText: "OK",
                    confirmButtonColor: "#E53935",
                    background: "#BDBDBD",
                    color: "#E53935"
                }).then(function() {
                    location.href = "../index.html";
                });
            </script>
        </body>
        </html>';
        exit;
    }

    try {
        $stmt = $conexao->prepare('SELECT * FROM administradores WHERE email = :email');
        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
        $stmt->execute();

        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario && password_verify($senha, $usuario["senha"]) && $codigo === "12345") {

            $_SESSION["id_usuario"] = $usuario["id"];
            $_SESSION["nome_usuario"] = $usuario["nome"];

            echo '<!DOCTYPE html>
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
                        title: "Bem-vindo!",
                        text: "Login realizado com sucesso!",
                        icon: "success",
                        confirmButtonText: "OK",
                        confirmButtonColor: "#E53935",
                        background: "#BDBDBD",
                        color: "#E53935"
                    }).then(function() {
                        location.href = "../view/consultarProprietario.html";
                    });
                </script>
            </body>
            </html>';
            exit;

        } else {
            echo '<!DOCTYPE html>
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
                        text: "E-mail, senha ou código inválidos.",
                        icon: "error",
                        confirmButtonText: "OK",
                        confirmButtonColor: "#E53935",
                        background: "#BDBDBD",
                        color: "#E53935"
                    }).then(function() {
                        location.href = "../index.html";
                    });
                </script>
            </body>
            </html>';
        }

    } catch (PDOException $e) {
        echo '<!DOCTYPE html>
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
                    text: "Erro ao realizar login.",
                    icon: "error",
                    confirmButtonText: "OK",
                    confirmButtonColor: "#E53935",
                    background: "#BDBDBD",
                    color: "#E53935"
                }).then(function() {
                    location.href = "../index.html";
                });
            </script>
        </body>
        </html>' . $e->getMessage();
    }
}
?>