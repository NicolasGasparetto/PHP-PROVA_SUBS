<?php
include_once('./conexao.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Cliente</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header>
        <nav>
            <ul>
                <a href="./index.php">
                    <li>Listar</li>
                </a>
                <a href="./cadastrar.php">
                    <li>Cadastrar</li>
                </a>
                <a href="./excluir.php">
                    <li>Excluir</li>
                </a>
                <a href="./editar.php">
                    <li>Editar</li>
                </a>
            </ul>
        </nav>
    </header>
    <h1></h1>
    <?php

    $queryCliente = "SELECT idCliente, nomeCompleto, cpf, dataAniversario, profissao, email, faleSobreVoce, telefone FROM php.prova_subs";
    $result = $pdo->prepare($queryCliente);
    $result->execute();

    if (($result) and ($result->rowCount() != 0)) {
    ?>
    <table>
        <thead>
            <tr>
                <th>idCliente</th>
                <th>nomeCompleto</th>
                <th>cpf</th>
                <th>dataAniversario</th>
                <th>profissao</th>
                <th>email</th>
                <th>faleSobreVoce</th>
                <th>Telefone</th>
            </tr>
        </thead>
        <tbody>
            <?php
                while ($rowTable = $result->fetch(PDO::FETCH_ASSOC)) {
                    extract($rowTable);
                ?>
            <tr>
                <td align="left"><?php echo $idCliente; ?></td>
                <td align="left"><?php echo $nomeCompleto; ?></td>
                <td align="left"><?php echo $cpf; ?></td>
                <td align="left"><?php echo $dataAniversario; ?></td>
                <td align="left"><?php echo $profissao; ?></td>
                <td align="left"><?php echo $email; ?></td>
                <td align="left"><?php echo $faleSobreVoce; ?></td>
                <td align="left"><?php echo $telefone; ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <?php
    } else {
        echo "<p style='color: red;'>Não existem registros a serem listados.</p><br>";
    }
    ?>
</body>

</html>