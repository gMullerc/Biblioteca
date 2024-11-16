<?php
$nomeBanco = 'meu_banco.db';
require 'sql_dao.php';

$mensagemErro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    try {
        $db = new SQLite3($nomeBanco);
        $query = "SELECT * FROM usuarios WHERE email = :email";
        $stmt = $db->prepare($query);
        $stmt->bindValue(':email', $email, SQLITE3_TEXT);
        $result = $stmt->execute();
        $usuario = $result->fetchArray(SQLITE3_ASSOC);

        if ($usuario && password_verify($senha, $usuario['senha'])) {
            header("Location: livros/listagem_livros.php");
            exit();
        } else {
            $mensagemErro = "E-mail ou senha incorretos.";
        }

        $db->close();
    } catch (Exception $e) {
        $mensagemErro = "Erro ao conectar ao banco de dados: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <div class="card">
        <h2>Acessar biblioteca virtual</h2>
        <form method="POST" action="index.php">
            <label for="email">E-mail:</label>
            <input type="email" name="email" id="email" required>

            <label for="senha">Senha:</label>
            <input type="password" name="senha" id="senha" required>

            <?php if ($mensagemErro): ?>
                <div style="color: red; margin-bottom: 20px;"><?php echo $mensagemErro; ?></div>
            <?php endif; ?>

            <button type="submit">Entrar</button>
        </form>
    </div>
</body>
</html>
