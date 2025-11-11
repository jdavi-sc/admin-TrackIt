<?php
require_once 'Conexao.php';

$placaAtual = strtoupper(trim($_POST['placaAtual'] ?? ''));
$novaPlaca = strtoupper(trim($_POST['novaPlaca'] ?? ''));

if (!empty($placaAtual) && !empty($novaPlaca)) {
    try {
        $check = $conexao->prepare("SELECT COUNT(*) FROM veiculos WHERE placa = :placaAtual");
        $check->bindParam(':placaAtual', $placaAtual);
        $check->execute();

        if ($check->fetchColumn() > 0) {

            $sql = "UPDATE veiculos SET placa = :novaPlaca WHERE placa = :placaAtual";
            $requisicao = $conexao->prepare($sql);
            $requisicao->bindParam(':novaPlaca', $novaPlaca);
            $requisicao->bindParam(':placaAtual', $placaAtual);
            $requisicao->execute();

            $checkUpdate = $conexao->prepare("SELECT COUNT(*) FROM veiculos WHERE placa = :novaPlaca");
            $checkUpdate->bindParam(':novaPlaca', $novaPlaca);
            $checkUpdate->execute();

            if ($checkUpdate->fetchColumn() > 0) {
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
                            text: "A placa do veículo foi atualizada com sucesso!",
                            icon: "success",
                            confirmButtonText: "OK",
                            confirmButtonColor: "#E53935",
                            background: "#BDBDBD",
                            color: "#E53935"
                        }).then(function() {
                            location.href = "../view/atualizarPlaca.html";
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
                            text: "A placa informada é a mesma já cadastrada.",
                            icon: "info",
                            confirmButtonText: "OK",
                            confirmButtonColor: "#E53935",
                            background: "#BDBDBD",
                            color: "#E53935"
                        }).then(function() {
                            location.href = "../view/atualizarPlaca.html";
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
                        location.href = "../view/atualizarPlaca.html";
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
                    text: "Erro ao atualizar a placa. Detalhes: ' . $e->getMessage() . '",
                    icon: "error",
                    confirmButtonText: "OK",
                    confirmButtonColor: "#E53935",
                    background: "#BDBDBD",
                    color: "#E53935"
                }).then(function() {
                    location.href = "../view/atualizarPlaca.html";
                });
            </script>
        </body>
        </html>';
    }
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
                location.href = "../view/atualizarPlaca.html";
            });
        </script>
    </body>
    </html>';
}
?>