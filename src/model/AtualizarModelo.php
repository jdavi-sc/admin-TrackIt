<?php
require_once 'Conexao.php';

$placa = $_POST['placa'] ?? '';
$novoModelo = $_POST['novoModelo'] ?? '';

if (!empty($placa) && !empty($novoModelo)) {
    try {

        $check = $conexao->prepare("SELECT COUNT(*) FROM veiculos WHERE placa = :placa");
        $check->bindParam(':placa', $placa);
        $check->execute();

        if ($check->fetchColumn() > 0) {
            
            $sql = "UPDATE veiculos SET modelo = :novoModelo WHERE placa = :placa";
            $requisicao = $conexao->prepare($sql);
            $requisicao->bindParam(':novoModelo', $novoModelo);
            $requisicao->bindParam(':placa', $placa);
            $requisicao->execute();

            if ($requisicao->rowCount() > 0) {
                echo '<!DOCTYPE html>
                <html>
                <head>
                    <title>Sucesso</title>
                    <link rel="icon" type="image/png" href="../assets/img/favicon.ico">
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    <style>* {font-family: Roboto, sans-serif;}</style>
                </head>
                <body>
                    <script>
                        Swal.fire({
                            title: "Sucesso!",
                            text: "O modelo do veículo foi atualizado com sucesso!",
                            icon: "success",
                            confirmButtonText: "OK",
                            confirmButtonColor: "#E53935",
                            background: "#BDBDBD",
                            color: "#E53935"
                        }).then(function() {
                            location.href = "../view/atualizarModelo.html";
                        });
                    </script>
                </body>
                </html>';
            } else {
                echo '<!DOCTYPE html>
                <html>
                <head>
                    <title>Nenhuma alteração</title>
                    <link rel="icon" type="image/png" href="../assets/img/favicon.ico">
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                    <style>* {font-family: Roboto, sans-serif;}</style>
                </head>
                <body>
                    <script>
                        Swal.fire({
                            title: "Aviso",
                            text: "O modelo informado é o mesmo já cadastrado para esta placa.",
                            icon: "info",
                            confirmButtonText: "OK",
                            confirmButtonColor: "#E53935",
                            background: "#BDBDBD",
                            color: "#E53935"
                        }).then(function() {
                            location.href = "../view/atualizarModelo.html";
                        });
                    </script>
                </body>
                </html>';
            }
        } else {
            echo '<!DOCTYPE html>
            <html>
            <head>
                <title>Placa não encontrada</title>
                <link rel="icon" type="image/png" href="../assets/img/favicon.ico">
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <style>* {font-family: Roboto, sans-serif;}</style>
            </head>
            <body>
                <script>
                    Swal.fire({
                        title: "Erro!",
                        text: "Nenhum veículo encontrado com a placa informada.",
                        icon: "error",
                        confirmButtonText: "OK",
                        confirmButtonColor: "#E53935",
                        background: "#BDBDBD",
                        color: "#E53935"
                    }).then(function() {
                        location.href = "../view/atualizarModelo.html";
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
            <script>
                Swal.fire({
                    title: "Erro!",
                    text: "Erro ao atualizar o modelo. Tente novamente.",
                    icon: "error",
                    confirmButtonText: "OK",
                    confirmButtonColor: "#E53935",
                    background: "#BDBDBD",
                    color: "#E53935"
                }).then(function() {
                    location.href = "../view/atualizarModelo.html";
                });
            </script>
        </body>
        </html>';
    }
} else {
    echo '<!DOCTYPE html>
    <html>
    <head>
        <title>Campos obrigatórios</title>
        <link rel="icon" type="image/png" href="../assets/img/favicon.ico">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <style>* {font-family: Roboto, sans-serif;}</style>
    </head>
    <body>
        <script>
            Swal.fire({
                title: "Erro!",
                text: "Preencha todos os campos obrigatórios.",
                icon: "error",
                confirmButtonText: "OK",
                confirmButtonColor: "#E53935",
                background: "#BDBDBD",
                color: "#E53935"
            }).then(function() {
                location.href = "../view/atualizarModelo.html";
            });
        </script>
    </body>
    </html>';
}
?>