<?php

    session_start();

    $mysqli = new mysqli('local', 'root', 'senha', 'bancoDados') or 
        die(mysqli_error($mysqli));
    
    //Definir strings vazias
    $valorColuna1 = '';
    $valorColuna2 = '';
    $id = 0;
    $update = false;


    //Método Incluir-Salvar
    if(isset($_POST['save'])){
        $valorColuna1 = $_POST['valorColuna1'];
        $valorColuna2 = $_POST['valorColuna2'];

        $mysqli->query("INSERT INTO NOME TABELA (coluna1, coluna2) VALUES ('$valorColuna1', '$valorColuna2')") or
            die($mysqli->error);

        $_SESSION['message'] = "Registro salvo com sucesso !";
        $_SESSION['msg_type'] = 'success';

        header("location: index.php");
    }

    //Deletar registro do banco
    if(isset($_GET['delete'])){
        $id = $_GET['delete'];
        $mysqli->query("DELETE FROM NOME TABELA WHERE id=$id") or 
            die($mysqli->error);

        $_SESSION['message'] = "Registro deletado com sucesso !";
        $_SESSION['msg_type'] = 'danger';

        header("location: index.php");
    }

    //Seleciona registros para edição
    if(isset($_GET['edit'])){
        $id = $_GET['edit'];
        $update = true;
        $result = $mysqli->query("SELECT * FROM NOME TABELA WHERE id=$id") or
            die($mysqli->error);
        
        error_reporting(0); // warning de count
        if(count($result) == 1){
            $row = $result->fetch_array();
            $valorColuna1 = $row['valorColuna1'];
            $valorColuna2 = $row['valorColuna2'];
        }
    }

    //Atualizar registro
    if(isset($_POST['update'])){
        $id = $_POST['id'];
        $valorColuna1 = $_POST['valorColuna1'];
        $valorColuna2 = $_POST['valorColuna2'];

        $mysqli->query("UPDATE NOME TABELA SET valorColuna1='$valorColuna1', $valorColuna2='$valorColuna2' WHERE id=$id") or
            die($mysqli->error);

        $_SESSION['message'] = "Registro atualizado com sucesso !";
        $_SESSION['msg_type'] = 'success';

        header("location: index.php");
    }