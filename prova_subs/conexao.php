<?php

try {
    $pdo = new PDO('mysql:host=localhost;dbname=php', 'root', 'positivo');
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $erro) {
    echo "ERRO => " . $erro->getMessage();
}