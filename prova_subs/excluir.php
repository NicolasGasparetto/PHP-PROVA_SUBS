<?php
include_once('./conexao.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Cliente</title>
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

    <h1>Excluir Cliente</h1>
    <?php
    $queryCliente = "SELECT idCliente, nomeCompleto, cpf, dataAniversario, profissao, email, faleSobreVoce, telefone FROM php.prova_subs";
    $result = $pdo->prepare($queryCliente);
    $result->execute();

    if (!empty($_REQUEST['id'])) {
        $id = $_REQUEST['id'];
        $queryClienteConsultaDelete = "SELECT * FROM php.prova_subs WHERE idCliente=$id";
        $resultConsultaDelete = $pdo->prepare($queryClienteConsultaDelete);
        $resultConsultaDelete->execute();

        if ($resultConsultaDelete->rowCount() > 0) {
            $sqlDelete = "DELETE FROM php.prova_subs WHERE idCliente=$id";
            $resultDeletar = $pdo->prepare($sqlDelete);
            $resultDeletar->execute();
            header("Refresh:1");
            echo date('H:i:s Y-m-d');
        }
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
                    <a class="btn btn-sm btn-danger" href="excluir.php?id=<?php echo $idCliente ?>">Excluir</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <?php
    } else {
        echo "<p style='color: red;'>Não existem registros a serem excluídos.</p><br>";
    }
    ?>
</body>

</html>