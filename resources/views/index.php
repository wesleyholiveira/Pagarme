<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta name="viewport" content="width=device-width, user-scalable=no">
        <meta charset="UTF-8" />
        <title>Pagarme - Projeto Marketplace</title>
        <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    </head>
    <body>
        <section id="fantasias">
            <h1>Fantasias</h1>
            <div class="container">
                <?php
                    foreach($fantasias as $fantasia):
                ?>
                <div class="fantasy">
                    <figure class="figure">
                        <img src="http://lorempixel.com/200/200" alt="<?=$fantasia->getNome()?>" />
                        <figcaption class="caption">
                            <?=$fantasia->getNome()?> <span class="price">R$ <?=$fantasia->getPreco()?></span>
                        </figcaption>
                    </figure>
                    <button class="btn-add-cart">ADICIONAR AO CARRINHO</button>
                </div>
                <?php
                    endforeach;
                ?>
            </section>
        </div>
    </body>
    <script src="<?= $src ?>"></script>
</html>