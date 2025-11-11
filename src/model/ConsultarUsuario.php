<?php
require_once "Conexao.php";

$emailDoUsuario = $_POST['email'] ?? '';

if (!empty($emailDoUsuario)) {
    $sql = "SELECT * FROM proprietario WHERE email = :email";
    $requisicao = $conexao->prepare($sql);
    $requisicao->bindParam(':email', $emailDoUsuario);

    try {
        $requisicao->execute();
        $usuario = $requisicao->fetch(PDO::FETCH_ASSOC);

        if ($usuario && isset($usuario['nomeCompleto'])) {
            ?>
            <!DOCTYPE html>
            <html lang="pt-br">
            <head>
                <meta charset="UTF-8">
                <title>Sucesso</title>
                <link rel="icon" type="image/png" href="../assets/img/favicon.ico">
                <style>

                    * {font-family: Roboto, sans-serif;}

                    body {
                        background-color: #BDBDBD;
                        display: flex;
                        flex-direction: column;
                        align-items: center;
                        justify-content: center;
                        height: 100vh;
                        margin: 0;
                    }
                    .card {
                        background-color: #fff;
                        padding: 30px 50px;
                        border-radius: 15px;
                        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
                        text-align: center;
                    }
                    h2 {
                        color: #000;
                    }
                    p {
                        font-size: 18px;
                        color: #555;
                        margin: 10px 0;
                    }
                    a {
                        display: inline-block;
                        margin-top: 20px;
                        text-decoration: none;
                        color: #fff;
                        background-color: #E53935;
                        padding: 10px 20px;
                        border-radius: 5px;
                    }
                    a:hover {
                        background-color: #b8211fff;
                    }
                </style>
            </head>
            <body>
                <div class="card">
                    <h2>Usuário encontrado!</h2>
                    <p><strong>Nome:</strong> <?= htmlspecialchars($usuario['nomeCompleto']) ?></p>
                    <p><strong>Email:</strong> <?= htmlspecialchars($usuario['email']) ?></p>
                    <a href="../view/consultarProprietario.html">Voltar</a>
                </div>
            </body>
            </html>
            <?php
        } else {
            echo '
            <!DOCTYPE html>
            <html>
            <head>
                <meta charset="UTF-8">
                <title>Erro</title>
                <link rel="icon" type="image/png" href="../assets/img/favicon.ico">
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <style>
                    * {font-family: Roboto, sans-serif;}
                </style>
            </head>
            <body style="background-color:#FFF;">
                <script>
                    Swal.fire({
                        title: "Erro!",
                        text: "Usuário não encontrado ou não existe!",
                        icon: "error",
                        confirmButtonText: "OK",
                        confirmButtonColor: "#E53935",
                        background: "#BDBDBD",
                        color: "#E53935"
                    }).then(() => {
                        location.href = "../view/consultarProprietario.html";
                    });
                </script>
            </body>
            </html>';
        }
    } catch (PDOException $e) {
        echo '
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <title>Erro</title>
            <link rel="icon" type="image/png" href="../assets/img/favicon.ico">
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <style>
                * {font-family: Roboto, sans-serif;}
            </style>
        </head>
        <body style="background-color:#FFF;">
            <script>
                Swal.fire({
                    title: "Erro!",
                    text: "Erro ao consultar, tente novamente.",
                    icon: "error",
                    confirmButtonText: "OK",
                    confirmButtonColor: "#E53935",
                    background: "#BDBDBD",
                    color: "#E53935"
                }).then(() => {
                    location.href = "../view/consultarProprietario.html";
                });
            </script>
        </body>
        </html>';
    }
} else {
    echo '
    <!DOCTYPE html>
    <html>
    <head>
        <meta charset="UTF-8">
        <title>Erro</title>
        <link rel="icon" type="image/png" href="../assets/img/favicon.ico">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <style>
           * {font-family: Roboto, sans-serif;}
        </style>
    </head>
    <body style="background-color:#FFF;">
        <script>
            Swal.fire({
                title: "Erro!",
                text: "Digite um email para realizar a consulta.",
                icon: "error",
                confirmButtonText: "OK",
                confirmButtonColor: "#E53935",
                background: "#BDBDBD",
                color: "#E53935"
            }).then(() => {
                location.href = "../view/consultarProprietario.html";
            });
        </script>
    </body>
    </html>';
}
?>