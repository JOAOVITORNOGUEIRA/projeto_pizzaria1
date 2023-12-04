<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/msFavicon.png" type="image/png">
    <link rel="stylesheet" href="index.css">
    <title>Pizzaria UNIFAA</title>
</head>
<body>
    <header>
        <h2 class="title">Carrinho com PHP</h2>
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="contato.php">Contato</a></li>
            </ul>
        </nav>
    </header>

    <div class="carrinho-container">
        <?php 
        $items = array(
            ['nome'=>'Calabresa', 'descricao' => 'Molho de tomate, queijo, calabresa, cebola e azeitonas.', 'imagem' => 'img/loja/pizza-1.png', 'preco' => '100'],
            ['nome'=>'Caipirinha', 'descricao' => 'Molho de tomate, queijo, presunto, palmito, milho e azeitonas.', 'imagem' => 'img/loja/pizza-2.png', 'preco' => '120'],
            ['nome'=>'Strogonoff', 'descricao' => 'Molho de tomate, queijo, carne de frango desfiada, molho strogonoff e batata palha.', 'imagem' => 'img/loja/pizza-3.png', 'preco' => '90'],
            ['nome'=>'Portuguesa', 'descricao' => 'Molho de tomate, queijo, presunto, ovos cozidos, cebola, pimentão, azeitonas e orégano.', 'imagem' => 'img/loja/pizza-4.png', 'preco' => '77'],
            ['nome'=>'Tomate', 'descricao' => 'Molho de tomate, queijo, tomate fatiado, manjericão e azeitonas.', 'imagem' => 'img/loja/pizza-5.png', 'preco' => '50'],
            ['nome'=>'Básica', 'descricao' => 'Molho de tomate, queijo e orégano.', 'imagem' => 'img/loja/pizza-6.png', 'preco' => '65']
        );

        foreach ($items as $key => $value) {
        ?>
            <div class="produto">
                <img src="<?php echo $value['imagem'] ?>" />
                <p><?php echo $value['nome'] ?></p>
                <p><?php echo $value['descricao'] ?></p>
                <p>Preço: R$ <?php echo number_format($value['preco'], 2, ',', '.'); ?></p>
                <a href="?adicionar=<?php echo $key ?>">Adicionar ao carrinho!</a>
            </div> <!--produto -->
        <?php
        }
        ?>
    </div> <!--carrinho-container -->

    <?php
    if(isset($_GET['adicionar'])){
        //vamos adicionar ao carrinho.
        $idProduto = (int) $_GET['adicionar'];
        if(isset($items[$idProduto])){
            if (isset($_SESSION['carrinho'][$idProduto])) {
                $_SESSION['carrinho'][$idProduto]['quantidade']++;
                $_SESSION['carrinho'][$idProduto]['total'] = $_SESSION['carrinho'][$idProduto]['quantidade'] * $items[$idProduto]['preco'];
            } else {
                $_SESSION['carrinho'][$idProduto] = array(
                    'quantidade' => 1,
                    'nome' => $items[$idProduto]['nome'],
                    'preco' => $items[$idProduto]['preco'],
                    'total' => $items[$idProduto]['preco'] // Inicializa o total com o preço do produto
                );
            }
            echo '<script>alert("O item foi adicionado ao carrinho");</script>';
            // Após adicionar ao carrinho, redirecionar para o index
            header('Location: index.php');
            exit();
        } else {
            die('Você não pode adicionar um item que não existe.');
        }
    }
    ?> 

    <h2 class="title">Carrinho:</h2>

    <?php
    foreach ($_SESSION['carrinho'] as $key => $value) {
        //Nome do produto
        //Quantidade
        //Preço
        echo '<div class="carrinho-item">';
        echo '<p>Nome: ' . $value['nome'] . ' | Quantidade: ' . $value['quantidade'] . ' | 
        Preço: R$ ' . number_format($value['preco'], 2, ',', '.') . ' | 
        Total: R$ ' . number_format($value['total'], 2, ',', '.') . ' </p>';
        // Adicionar botões para apagar e atualizar
        echo '<a href="?apagar=' . $key . '">Apagar</a> | <a href="?atualizar=' . $key . '">Atualizar</a>';
        echo '</div>';
    }

    // Adicionar a lógica para apagar o item do carrinho
    if(isset($_GET['apagar'])){
        $idProduto = (int) $_GET['apagar'];
        if(isset($_SESSION['carrinho'][$idProduto])){
            unset($_SESSION['carrinho'][$idProduto]);
            echo '<script>alert("O item foi removido do carrinho");</script>';
            // Após apagar o item, redirecionar para o index
            header('Location: index.php');
            exit();
        } else {
            die('Você não pode apagar um item que não existe.');
        }
    }

    // Adicionar a lógica para atualizar a quantidade do item no carrinho
    if(isset($_GET['atualizar'])){
        $idProduto = (int) $_GET['atualizar'];
        $novaQuantidade = isset($_POST['quantidade']) ? (int)$_POST['quantidade'] : 0;
        if(isset($_SESSION['carrinho'][$idProduto])){
            $_SESSION['carrinho'][$idProduto]['quantidade'] = $novaQuantidade;
            $_SESSION['carrinho'][$idProduto]['total'] = $novaQuantidade * $items[$idProduto]['preco'];
            echo '<script>alert("A quantidade foi atualizada no carrinho");</script>';
            // Após atualizar a quantidade, redirecionar para o index
            header('Location: index.php');
            exit();
        } else {
            die('Você não pode atualizar a quantidade de um item que não existe.');
        }
    }
    ?>
</body>
</html>
