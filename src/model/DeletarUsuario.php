<?php

    require_once 'Conexao.php';

    $email = $_POST['email'];

    if(!empty($email)) {
        
        $sql = "DELETE FROM proprietario WHERE email = :email";
        
        $requisicao = $conexao->prepare($sql);
    
        $requisicao->bindParam(':email', $email);
        
        try {
            $requisicao->execute();
            if ($requisicao->rowCount() > 0) {
                echo' <!DOCTYPE html>
        <html>
        <head>
            <title>Sucesso</title>
            <link rel="icon" type="image/png" href="../assets/img/favicon.ico">
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <style>
                * {font-family: Roboto, sans-serif;}
            </style>
        </head>
            <body>
                <script type="text/javascript">
                    Swal.fire({
                        title: "Remoção Realizada",
                        text: "Usuario removido com sucesso.",
                        icon: "success",
                        confirmButtomText: "OK",
                        confirmButtonColor: "#E53935",
                        background: "#BDBDBD",
                        color: "#E53935"
                    }).then(function() {
                         location.href = "../view/deletarProprietario.html"
                    });
                </script>
            </body>
        </html>';
            } else {
                 echo '<!DOCTYPE html>
        <html>
        <head>
            <title>Erro</title>
            <link rel="icon" type="image/png" href="../assets/img/favicon.ico">
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <style>
                * {font-family: Roboto, sans-serif;}
            </style>
        </head>
        <body>
            <script type="text/javascript">
                Swal.fire({
                title: "Erro!",
                text: "O usuário não existe",
                icon: "error",
                confirmButtomText: "OK",
                confirmButtonColor: "#E53935",
                background: "#BDBDBD",
                color: "#E53935"
                }).then(function() {
                    location.href = "../view/deletarProprietario.html"
                });
            </script>
        </body>
    </html>';
            }
        } catch(PDOException $e){
             echo ' <!DOCTYPE html>
        <html>
        <head>
            <title>Erro</title>
            <link rel="icon" type="image/png" href="../assets/img/favicon.ico">
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <style>
                * {font-family: Roboto, sans-serif;}
            </style>
        </head>
        <body>
            <script type="text/javascript">
                Swal.fire({
                title: "Erro!",
                text: "Erro ao remover",
                icon: "error",
                confirmButtomText: "OK",
                confirmButtonColor: "#E53935",
                background: "#BDBDBD",
                color: "#E53935"
                }).then(function() {
                    location.href = "../view/deletarProprietario.html"
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
            <style>
                * {font-family: Roboto, sans-serif;}
            </style>
        </head>
        <body>
            <script type="text/javascript">
                Swal.fire({
                title: "Erro!",
                text: "Informe um e-mail para remover um usuário",
                icon: "error",
                confirmButtomText: "OK",
                confirmButtonColor: "#E53935",
                background: "#BDBDBD",
                color: "#E53935"
                }).then(function() {
                    location.href = "../view/deletarProprietario.html"
                });
            </script>
        </body>
    </html>';
    }

?>