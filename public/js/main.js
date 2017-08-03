(function() {

    var itens = [];

    cartMenu(itens);
    adicionarAoCarrinho(itens);
    finalizarCompra(itens);

    function finalizarCompra(itens) {

        document.getElementById('finalizarCompra').addEventListener('click', function() {
            var http = new XMLHttpRequest();
            var btn = this;
            var original = btn.innerHTML;

            btn.disabled = true;
            btn.innerHTML = 'Processando';

            http.onload = function(response) {
                btn.disabled = false;
                btn.innerHTML = original;
            };
            http.onreadystatechange = function() {//Call a function when the state changes.
                if(http.readyState === 4 && http.status === 200) {
                    var resposta = JSON.parse(http.responseText);
                    swal('Parabéns!', resposta.descricao, 'success');
                }
            };
            http.open("post", "checkout", true);
            http.setRequestHeader("Content-Type", "application/json");
            http.send(JSON.stringify(itens));
        });
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
                var parent = this.parentNode;
                var nome = parent.querySelector('input[name="nome"]').value;
                var valor = parent.querySelector('input[name="valor"]').value;

                itens.push({
                    nome: nome,
                    valor: valor
                });

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
