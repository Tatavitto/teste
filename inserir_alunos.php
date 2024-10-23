<?php
$servidor = 'localhost';
$banco = 'sistema_notas';
$usuario = 'root';
$senha = '';

try {
    $conn = new PDO("mysql:host=$servidor;dbname=$banco", $usuario, $senha);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome_aluno = trim($_POST["nome"]);
        $id_turma = $_POST["turma"];
        $erro = "";

        if (empty($nome_aluno)) {
            $erro = "O nome do aluno é obrigatório.";
        } else {
            // Verifica se a turma existe
            $stmt = $conn->prepare("SELECT id FROM turmas WHERE id = :id_turma");
            $stmt->execute([':id_turma' => $id_turma]);

            if ($stmt->rowCount() === 0) {
                $erro = "A turma selecionada não existe.";
            } else {
                // Prepara a inserção no banco de dados
                $stmt = $conn->prepare("INSERT INTO alunos (nome, id_turma) VALUES (:nome, :id_turma)");
                $stmt->execute([':nome' => $nome_aluno, ':id_turma' => $id_turma]);
                echo "Aluno cadastrado com sucesso!";
            }
        }
    }
} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
}

$conn = null;
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
