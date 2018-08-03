<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Conversor de Moeda</title>
</head>
<body>
<div>

    <div data-js="error"></div>
    <form method="post" data-js="form">
        <input type="text" name="valor" data-js="valor" placeholder="Digite o valor a ser convertido" required>
        <select name="moeda" data-js="moeda" required>
            <option value="" selected>Selecione...</option>
            <option value="1">Dólar</option>
            <option value="2">Real</option>
        </select>
        <input type="text" name="result" data-js="retorno">
        <input type="submit" name="enviar" value="Enviar">
    </form>
</div>
</body>
<script>
    (function () {
        let $form = document.querySelector('[data-js="form"]');

        function getDolar() {
            return fetch('http://economia.awesomeapi.com.br/USD-BRL/1', {
                method: 'get'
            });
        }

        $form.addEventListener('submit', function(event) {
            event.preventDefault();

            let valorDolar = getDolar();

            valorDolar.then(response => response.json()) // retorna uma promise
                .then(result => {
                    let $valor = document.querySelector('[data-js="valor"]');
                    let $resultado = document.querySelector('[data-js="retorno"]');
                    let $moeda = document.querySelector('[data-js="moeda"]');

                    if ($moeda.value == 1) {
                        $resultado.value = result[0].bid * $valor.value;
                    } else {
                        $resultado.value =   $valor.value / result[0].bid;
                    }
                })
                .catch(function(err) {
                    console.error(err);
                });
        })
    })();
</script>
</html>