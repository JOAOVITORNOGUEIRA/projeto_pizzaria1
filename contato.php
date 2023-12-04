<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/msFavicon.png" type="image/png">
    <link rel="stylesheet" href="css/style.css"> <!-- Certifique-se de ajustar o caminho se necessário -->
    <link rel="stylesheet" href="css/contato.css"> <!-- Adicionando o estilo para o formulário de contato -->
    <title>Pizzaria UNIFAA</title>
</head>
<body>
    <header>
        <h2 class="title">Entre em Contato</h2>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="contato.php">Contato</a></li>
            </ul>
        </nav>
    </header>

    <section class="contato-section">
        <h2>Entre em Contato</h2>
        <p>Para fazer pedidos ou tirar dúvidas, entre em contato conosco.</p>
        <p>Envie-nos uma mensagem:</p>

        <form action="processar_contato.php" method="post">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>

            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" required>

            <label for="mensagem">Mensagem:</label>
            <textarea id="mensagem" name="mensagem" rows="4" required></textarea>

            <button type="submit">Enviar Mensagem</button>
        </form>
    </section>

    <footer>
        <p>Endereço: Rua das Pizzas, 123 - Pizzalândia | Telefone: (11) 1234-5678</p>
        <p>Siga-nos nas redes sociais: <a href="#">Facebook</a>, <a href="#">Instagram</a>, <a href="#">Twitter</a></p>
    </footer>
</body>
</html>
