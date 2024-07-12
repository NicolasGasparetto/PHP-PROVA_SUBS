<?php
include_once('./conexao.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente</title>
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

    <h1>Editar Cliente</h1>
    <?php
    $queryCliente = "SELECT idCliente, nomeCompleto, cpf, dataAniversario, profissao, email, faleSobreVoce, telefone FROM php.prova_subs";
    $result = $pdo->prepare($queryCliente);
    $result->execute();

    if (!empty($_REQUEST['id'])) {
        $id = $_REQUEST['id'];
        $queryClienteConsultaUpdate = "SELECT * FROM php.prova_subs WHERE idCliente=$id";

        $resultConsultaUpdate = $pdo->prepare($queryClienteConsultaUpdate);
        $resultConsultaUpdate->execute();
        $rowTableEditar = $resultConsultaUpdate->fetch(PDO::FETCH_ASSOC);
    ?>

    <form name="AtualizarCliente" method="GET" action="">
        <label>ID:</label>
        <input type="text" name="id" value="<?php echo $rowTableEditar['idCliente'] ?>"><br><br>
        <label>Nome Completo:</label>
        <input type="text" name="nomeCompleto" id="nomeCompleto" placeholder="Nome Completo"
            value="<?php echo $rowTableEditar['nomeCompleto'] ?>"><br><br>

        <label>cpf:</label>
        <input type="text" name="cpf" id="cpf" placeholder="cpf" value="<?php echo $rowTableEditar['cpf'] ?>"><br><br>

        <label>data Aniversario:</label>
        <input type="text" name="dataAniversario" id="dataAniversario" placeholder="data Aniversario"
            value="<?php echo $rowTableEditar['dataAniversario'] ?>"><br><br>

        <label>profissao:</label>
        <input type="text" name="profissao" id="profissao" placeholder="profissao"
            value="<?php echo $rowTableEditar['profissao'] ?>"><br><br>

        <label>email:</label>
        <input type="email" name="email" id="email" placeholder="email"
            value="<?php echo $rowTableEditar['email'] ?>"><br><br>

        <label>fale Sobre Voce:</label>
        <input type="faleSobreVoce" name="faleSobreVoce" id="faleSobreVoce" placeholder="fale Sobre Voce"
            value="<?php echo $rowTableEditar['faleSobreVoce'] ?>"><br><br>

        <label>Telefone:</label>
        <input type="text" name="telefone" id="telefone" placeholder="Telefone"
            value="<?php echo $rowTableEditar['telefone'] ?>"><br><br>

        <input type="submit" value="Atualizar" name="Atualizarclie"><br><br>
    </form>

    <?php

        $dados = filter_input_array(INPUT_GET, FILTER_DEFAULT);

        if (!empty($dados['AtualizarClie'])) {
            $sqlUpdate = "UPDATE php.prova_subs
                          SET nomeCompleto = '" . $dados['nomeCompleto'] . "',
                          cpf = '" . $dados['cpf'] . "', 
                          dataAniversario = '" . $dados['dataAniversario'] . "',
                          profissao = '" . $dados['profissao'] . "',
                          email = '" . $dados['email'] . "',
                          dddfaleSobreVoce = '" . $dados['faleSobreVoce'] . "',
                          telefone = '" . $dados['telefone'] . "'
                          WHERE idCliente=$id";
            $resultAtualizar = $pdo->prepare($sqlUpdate);
            $resultAtualizar->execute();
            header("Refresh:1");
            echo date('H:i:s Y-m-d');
        }
        ?>

    <?php
    }

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
                <td align="center">
                    <a class="btn btn-sm btn-danger" href="editar.php?id=<?php echo $idCliente ?>">Editar</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <?php
    } else {
        echo "<p style='color: red;'>Erro: Cliente não encontrado!</p><br>";
    }
    ?>
</body>

</html>