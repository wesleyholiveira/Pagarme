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
                                        <span class="price">R$ <?= \App\Helpers\Helpers::moneyFormat($fantasia->getValor()) ?></span>
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
            </section>
            <ul class="bar">
                <li>
                    <a href="#" class="cart">
                        <i class="badge" id="badget"></i>
                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                    </a>
                </li>
            </ul>
        </div>
    </body>
    <script src="<?= $src ?>"></script>
    <script>
       var listaBotoes = document.getElementsByClassName('btn-add-cart');
       var clicks = 1;
       for (i = 0; i < listaBotoes.length; i++) {
           listaBotoes[i].addEventListener('click', function(e) {
               var badge = document.getElementsByClassName('badge')[0];
               badge.innerHTML = clicks;
               badge.className = badge.className.replace(' badge-animation', '');

               setTimeout(function() {
                   badge.className += ' badge-animation';
               }, 50);

               clicks++;
               e.preventDefault();
           });
       }
    </script>
</html>