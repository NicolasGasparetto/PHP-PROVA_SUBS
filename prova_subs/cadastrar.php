<?php
include_once('./conexao.php');
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Cliente</title>
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
    <h1>Cadastrar Clientes</h1>

    <?php
    $dados = filter_input_array(INPUT_GET, FILTER_DEFAULT);

    if (!empty($dados['cadastrarClie'])) {

        $empty_input = false;
        $dados = array_map('trim', $dados);
        if (in_array("", $dados)) {
            $empty_input = true;
            echo "<p style='color: red;'>Existem campos em branco!</p><br>";
        } elseif (!filter_var($dados['email'], FILTER_VALIDATE_EMAIL)) {
            $empty_input = true;
            echo "<p style='color: red;'>E-mail informado não é válido!</p><br>";
        }

        if ($empty_input == false) {
            $queryClie = "INSERT INTO php.prova_subs (idCliente, nomeCompleto, cpf, dataAniversario, profissao, email, faleSobreVoce, telefone) VALUES('" . $dados['idCliente'] . "', '" . $dados['nomeCompleto'] . "', '" . $dados['cpf'] . "', '" . $dados['dataAniversario'] . "', '" . $dados['profissao'] . "', '" . $dados['email'] . "', '" . $dados['faleSobreVoce'] . "', '" . $dados['telefone'] . "')";

            $cadCliente = $pdo->prepare($queryClie);
            $cadCliente->execute();

            if ($cadCliente->rowCount()) {
                echo "<p style='color: green;'>cliente cadastrado com sucesso!</p><br>";
                unset($dados);
            } else {
                echo "<p style='color: red;'>Erro: cliente não cadastrado!</p><br>";
            }
        } else {
            echo "<p style='color: red;'>Erro: Existem campos em branco ou e-mail inválido!</p><br>";
        }
    }

    ?>

    <form name="cadastrarCliente" method="GET" action="">
        <label>ID Cliente:</label>
        <input type="text" name="idCliente" id="idCliente" placeholder="ID Cliente" value="<?php if (isset($dados['idCliente'])) {
                                                                                                echo $dados['idCliente'];
                                                                                         } ?>"><br><br>

        <label>nome Completo:</label>
        <input type="text" name="nomeCompleto" id="nomeCompleto" placeholder="nome Completo" value="<?php if (isset($dados['nomeCompleto'])) {
                                                                                                        echo $dados['nomeCompleto'];
                                                                                                    } ?>"><br><br>

        <label>cpf:</label>
        <input type="text" name="cpf" id="cpf" placeholder="cpf" value="<?php if (isset($dados['cpf'])) {
                                                                            echo $dados['cpf'];
                                                                        } ?>"><br><br>

        <label>data Aniversario:</label>
        <input type="text" name="dataAniversario" id="dataAniversario" placeholder="data Aniversario"
            value="<?php if (isset($dados['dataAniversario'])) {
                                                                                                                        echo $dados['dataAniversario'];
                                                                                                                    } ?>"><br><br>

        <label>profissao:</label>
        <input type="text" name="profissao" id="profissao" placeholder="profissao" value="<?php if (isset($dados['profissao'])) {
                                                                                                echo $dados['profissao'];
                                                                                            } ?>"><br><br>

        <label>email:</label>
        <input type="email" name="email" id="email" placeholder="email" value="<?php if (isset($dados['email'])) {
                                                                                    echo $dados['email'];
                                                                                } ?>"><br><br>

        <label>fale Sobre Voce:</label>
        <input type="text" name="faleSobreVoce" id="faleSobreVoce" placeholder="fale Sobre Voce" value="<?php if (isset($dados['dddfaleSobreVoce'])) {
                                                                                                            echo $dados['faleSobreVoce'];
                                                                                                        } ?>"><br><br>

        <label>Telefone:</label>
        <input type="text" name="telefone" id="telefone" placeholder="Telefone" value="<?php if (isset($dados['telefone'])) {
                                                                                            echo $dados['telefone'];
                                                                                        } ?>"><br><br>

        <input type="submit" value="Cadastrar" name="cadastrarClie">
    </form>

</body>

</html>