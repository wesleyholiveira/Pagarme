<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta name="viewport" content="width=device-width, user-scalable=yes">
        <meta charset="UTF-8" />
        <title>Pagarme - Projeto Marketplace</title>
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    </head>
    <body>
        <section id="fantasias">
            <h1>Fantasias</h1>
            <div class="container">
                <?php
                    if(is_array($response)) {
                        foreach ($response as $fantasia) {
                            ?>
                            <div class="fantasy">
                                <figure class="figure">
                                    <img src="<?= $fantasia->getImagem()->getUri() ?>"
                                         alt="<?= $fantasia->getDescricao() ?>"/>
                                    <figcaption class="caption">
                                        <?= $fantasia->getDescricao() ?>
                                        <span class="price"><?= \App\Helpers\Helpers::moneyFormat($fantasia->getValor()) ?></span>
                                    </figcaption>
                                </figure>
                                <input type="hidden" name="nome" value="<?=$fantasia->getFornecedor()->getNome()?>">
                                <input type="hidden" name="valor" value="<?=$fantasia->getValor()?>">
                                <button class="btn-add-cart">ADICIONAR AO CARRINHO</button>
                            </div>
                            <?php
                        }
                    } else {
                        echo $response;
                    }
                ?>
                <button class="btn-checkout" id="finalizarCompra">Finalizar Compra</button>
            </div>
        </section>
        <ul class="bar">
            <li class="cart">
                <a href="#">
                    <i class="badge" id="badget"></i>
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                </a>
            </li>
            <li>
                <ul class="main-items">
                    <?php
                    if(is_array($response)) {
                        foreach ($response as $fantasia) {
                    ?>
                    <li class="items">
                        <a href="<?=$uri . '/fantasia/' . $fantasia->getId() ?>">
                            <img src="<?=$fantasia->getImagem()->getUri()?>">
                        </a>
                    </li>
                    <?php
                        }
                    }
                    ?>
                </ul>
            </li>
        </ul>
    </body>
    <script src="<?= $src ?>"></script>
</html>
