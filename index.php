<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>CRUD</title>
    <h1>Interação com Banco de Dados</h1> 

    <!-- SCRIPTS BÁSICOS DE FRONT END -->
    <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    
    
</head>
<body>
    <?php require_once "interacoesComBanco.php"; ?>

    <!-- TIPO DE MENSAGEM EM QUALQUER AÇÃO -->
    <?php
    if(isset($_SESSION['message'])): ?>
        <div class="alert alert-<?=$_SESSION['msg_type']?>">
            <?php
                echo $_SESSION['message'];
            ?>
        </div>
    <?php endif ?>

    <!-- FORMATAÇÃO DA PÁGINA -->
    <div class='container'> 

    <?php
    $mysqli = new mysqli('localhost', 'root', 'MatheusQwerty123', 'crud') or die(mysqli_error($mysqli));
    $result = $mysqli->query("SELECT * FROM NOME TABELA");
    ?>
    
    <!-- ESQUELETO DA TABELA DE REGISTRO -->
    <div class='row justify-content-center'>
        <table class='table'>
            <thead>
                <tr>
                    <th>valorColuna1</th>
                    <th>valorColuna2</th>
                    <th colspan='2'>Action</th>
                </tr>
            </thead>
    <?php
        while($row = $result->fetch_assoc()):?>

    <!-- PREENCHIMENTO DA TABELA DE REGISTRO -->
            <tr>
                <td><?php echo $row["valorColuna1"]; ?></td>
                <td><?php echo $row['valorColuna2']; ?></td>
                <td>
                    <!-- BOTÕES -->
                    <a href="index.php?edit=<?php echo $row['id']; ?>"
                        class='btn btn-info'>Editar</a>
                    <a href="index.php?delete=<?php echo $row['id']; ?>"
                        class='btn btn-danger'>Deletar</a>
                </td>
            </tr>
        <?php endwhile; ?>
        </table>
    </div>
    
    <!-- FORMATAÇÃO DOS INPUTS-->
    <div class="row justify-content-center">
        <form action="interacoesComBanco.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            
            <div class="form-group">
            <label>valorColuna1: </label>
            <input type="text" name='valorColuna1' class="form-control" 
                   value="<?php echo $valorColuna1; ?>" placeholder="Digite seu valorColuna1: ">
            </div>
            <div class="form-group">
            <label>valorColuna2: </label>
            <input type="text" name='valorColuna2' class="form-control"
                    value="<?php echo $valorColuna2; ?>" placeholder="Informe seu número: ">
            </div>
            <div class="form-group">
            <?php 
            if($update):
            ?>
                <button type="submit" class="btn btn-info" name='update'>ATUALIZAR REGISTRO</button>
            <?php else: ?>
                <button type="submit" class="btn btn-info" name='save'>SALVAR REGISTRO</button>
            <?php endif ?>
            </div>
        </form>
    </div>
    </div>
</body>
</html>