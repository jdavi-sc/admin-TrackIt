<?php
    require_once 'Conexao.php';

    $nome = $_POST['nome'];
    $email  = $_POST['email'];
    $senha = $_POST['senha']; 
    
    if(!empty($nome) && !empty($email) && !empty($senha)){

        $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

        $sql = "INSERT INTO administradores (nome, email, senha) VALUES (:nome, :email, :senha)";

        $requisicao = $conexao->prepare($sql);

        $requisicao->bindParam(':nome', $nome);
        $requisicao->bindParam(':email', $email);
        $requisicao->bindParam(':senha', $senhaHash);
        
        try{
            $requisicao->execute();
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
                        title: "Cadastro Realizado",
                        text: "Cadastro Concluído Com Sucesso.",
                        icon: "success",
                        confirmButtomText: "OK",
                        confirmButtonColor: "#E53935",
                        background: "#BDBDBD",
                        color: "#E53935"
                    }).then(function() {
                         location.href = "../index.html";
                    });
                </script>
            </body>
        </html>';
        }catch(PDOException $e){
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
            text: "Erro ao cadastrar",
            icon: "error",
            confirmButtomText: "OK",
            confirmButtonColor: "#E53935",
            background: "#BDBDBD",
            color: "#E53935"
        }).then(function() {
            location.href = "../index.html"
        });
        </script>
    </body>
    </html>' . $e->getMessage();
        }

    }else{
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
            text: "Erro ao cadastrar",
            icon: "error",
            confirmButtomText: "OK",
            confirmButtonColor: "#E53935",
            background: "#BDBDBD",
            color: "#E53935"
        }).then(function() {
            location.href = "../index.html"
        });
        </script>
    </body>
    </html>';
}

?>