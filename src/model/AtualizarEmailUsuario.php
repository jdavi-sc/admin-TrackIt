<?php
require_once 'Conexao.php';

$emailAtual = $_POST['emailAtual'] ?? '';
$novoEmail = $_POST['novoEmail'] ?? '';

if (empty($emailAtual) || empty($novoEmail)) {
    echoSweetAlert("Erro!", "Preencha todos os campos para atualizar o nome.", "error");
    exit;
}

try {
    $check = $conexao->prepare("SELECT * FROM proprietario WHERE email = :emailAtual");
    $check->bindParam(':emailAtual', $emailAtual);
    $check->execute();
    $emailUsuario = $check->fetch(PDO::FETCH_ASSOC);

    if ($emailUsuario) {
        $update = $conexao->prepare("UPDATE proprietario SET email = :novoEmail WHERE email = :emailAtual");
        $update->bindParam(':novoEmail', $novoEmail);
        $update->bindParam(':emailAtual', $emailAtual);
        $update->execute();

        if ($update->rowCount() > 0) {
            echoSweetAlert("Sucesso!", "O e-mail foi atualizado com sucesso!", "success");
        } 
    } else {
        echoSweetAlert("Erro!", "E-mail não encontrado no sistema.", "error");
    }
} catch (PDOException $e) {
    echoSweetAlert("Erro!", "Falha ao processar a solicitação. Tente novamente.", "error");
}

function echoSweetAlert($titulo, $texto, $icone)
{
    echo '<!DOCTYPE html>
    <html>
    <head>
        <title>' . $titulo . '</title>
        <link rel="icon" type="image/png" href="../assets/img/favicon.ico">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <style>* {font-family: Roboto, sans-serif;}</style>
    </head>
    <body>
        <script>
            Swal.fire({
                title: "' . $titulo . '",
                text: "' . $texto . '",
                icon: "' . $icone . '",
                confirmButtonText: "OK",
                confirmButtonColor: "#E53935",
                background: "#BDBDBD",
                color: "#E53935"
            }).then(function() {
                location.href = "../view/atualizarNomeProprietario.html";
            });
        </script>
    </body>
    </html>';
}
?>