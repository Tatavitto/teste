<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Aluno</title>
</head>
<body>
    <h1>Cadastrar Novo Aluno</h1>
    <form action="inserir_alunos.php" method="POST">
        <label for="nome">Nome do Aluno:</label>
        <input type="text" name="nome" required><br>

        <label for="turma">Selecionar Turma:</label>
        <select name="turma" required>
            <option value="">Escolha uma turma</option>
            <?php
            $servidor = 'localhost';
            $banco = 'sistema_notas';
            $usuario = 'root';
            $senha = '';

            try {
                $conn = new PDO("mysql:host=$servidor;dbname=$banco", $usuario, $senha);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                $stmt = $conn->query("SELECT id, nome FROM turmas");
                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<option value='{$row['id']}'>{$row['nome']}</option>";
                }
            } catch (PDOException $e) {
                echo "Erro: " . $e->getMessage();
            }
            ?>
        </select><br>

        <input type="submit" value="Cadastrar">
    </form>
</body>
</html>
