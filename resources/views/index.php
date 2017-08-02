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
    <script>
        (function() {

            var itens = [];

//            finalizarCompra();
            cartMenu(itens);
            adicionarAoCarrinho(itens);

            function finalizarCompra() {
                var oReq = new XMLHttpRequest();
                oReq.onload = function(response) {
                    console.log(response);
                };
                oReq.open("get", "fantasia", true);
                oReq.send();
            }

            function cartMenu(itens) {
                var cart = document.getElementsByClassName('cart')[0];
                var className = cart.parentNode.className;
                cart.addEventListener('click', function() {
                    if(itens.length > 0) {
                        this.parentNode.className = className;
                        this.parentNode.className += ' bar-animation';
                    }
                });
            }

            function adicionarAoCarrinho(itens) {
                var finalizarCompra = document.getElementById('finalizarCompra');
                var listaBotoes = document.getElementsByClassName('btn-add-cart');
                var listaSubIcones = document.getElementsByClassName('items');
                var badge = document.getElementsByClassName('badge')[0];
                var badgeClassName = badge.className;
                var j = 0;
                for (i = 0; i < listaBotoes.length; i++) {
                    listaBotoes[i].addEventListener('click', function(e) {
                        itens.push(this.parentNode);

                        finalizarCompra.style.display = 'block';
                        listaSubIcones[j].style.display = 'inline-block';
                        badge.innerHTML = itens.length;
                        badge.className = badgeClassName;

                        setTimeout(function() {
                            badge.className += ' badge-animation';
                        }, 50);

                        this.innerHTML = 'ADICIONADO';
                        this.disabled = true;

                        j++;
                        e.preventDefault();
                    });
                }
            }
        })();


    </script>
</html>