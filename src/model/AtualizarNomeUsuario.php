<?php
require_once 'Conexao.php';

$email = $_POST['email'] ?? '';
$novoNome = $_POST['nome'] ?? '';

if (empty($email) || empty($novoNome)) {
    echoSweetAlert("Erro!", "Preencha todos os campos para atualizar o nome.", "error");
    exit;
}

try {
    $check = $conexao->prepare("SELECT * FROM proprietario WHERE email = :email");
    $check->bindParam(':email', $email);
    $check->execute();
    $usuario = $check->fetch(PDO::FETCH_ASSOC);

    if ($usuario) {
        $update = $conexao->prepare("UPDATE proprietario SET nomeCompleto = :novoNome WHERE email = :email");
        $update->bindParam(':novoNome', $novoNome);
        $update->bindParam(':email', $email);
        $update->execute();

        if ($update->rowCount() > 0) {
            echoSweetAlert("Sucesso!", "O nome foi atualizado com sucesso!", "success");
        } else {
            echoSweetAlert("Aviso!", "O nome informado é igual ao anterior.", "info");
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