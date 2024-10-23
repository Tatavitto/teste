<?php
$servidor = 'localhost';
$banco = 'sistema_notas';
$usuario = 'root';
$senha = '';

$conexao = new PDO("mysql:host=$servidor;dbname=$banco", $usuario, $senha);

$codigoSQL = "INSERT INTO `turmas` (`id`, `nome`) VALUES (NULL, :nm)";

try {
    if ($_SERVER["REQUEST_METHOD"] == "GET") {
        $nome_turma = trim($_GET["nome"] ?? '');

        if (empty($nome_turma)) {
            $erro = "O nome da turma é obrigatório.";
        } else {
            $comando = $conexao->prepare($codigoSQL);
            $resultado = $comando->execute(array('nm' => $_GET['nome']));
        }

    
    
    
    if($resultado) {
	echo "Comando executado!";
    } else {
	echo "Erro ao executar o comando!";
    }
    }
}
catch (Exception $e) {
    echo "Erro $e";
}

$conexao = null;
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado da Inserção</title>
</head>
<body>
    <?php if (!empty($erro)): ?>
        <p style="color: red;"><?php echo $erro; ?></p>
    <?php endif; ?>
</body>
</html>
