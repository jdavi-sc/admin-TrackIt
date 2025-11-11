<?php

    $requisicao = $_POST['requisicao'];

    switch ($requisicao) {
        
        case 'Consultar';
            include '../model/ConsultarUsuario.php';
            break;

        case 'Atualizar Nome';
            include '../model/AtualizarNomeUsuario.php';
            break;
            
        case 'Atualizar Email';
            include '../model/AtualizarEmailUsuario.php';
            break;

        case 'Atualizar Senha';
            include '../model/AtualizarSenhaUsuario.php';
            break;

        case 'Deletar';
            include '../model/DeletarUsuario.php';
            break;

        case 'Atualizar Modelo';
            include '../model/AtualizarModelo.php';
            break;

        case 'Atualizar Placa';
            include '../model/AtualizarPlaca.php';
            break;
    }

?>