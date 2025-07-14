<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <div class="container">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-3">Prueba de Integración con Mercado Pago</h2>
            <div id="mercadopago-button"></div>

            {{-- Incluimos el SDK de JS de Mercado Pago --}}
            <script src="https://sdk.mercadopago.com/js/v2"></script>
            <script>
                const mp = new MercadoPago('<?= $mpPublicKey;?>');
                mp.bricks().create('wallet', 'mercadopago-button', {
                    initialization: {
                        // Noten que preferenceId debe ser un string.
                        // El valor del id lo obtenemos del objeto Preference.
                        preferenceId: '<?= $preference->id;?>',
                    }
                });
            </script>
        </div>
    </div>
</div>

</body>
</html>
