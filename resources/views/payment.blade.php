<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Descom Payment Demo</title>
</head>

<body>
    <div class="container">
        <header>
            <h1>Método de pago de pruebas</h1>
            <p>
                Este método de pago ha sido desarrollado por Descom para testear los procesos de compra.
            </p>
        </header>

        <div class="resume">
            <h2>Resume Pedido #{{ $transactionId }}</h2>
            <p>
                {{ $description }}
            </p>
            <span>
                {{ $amount }} €
            </span>
        </div>

        <div class="form">
            <h2>Seleccione el resultado de la transacción:</h2>

            <div>
                <form method="POST" action="/payment/process">
                    <input type="hidden" name="transition_id" value="{{ $transactionId }}" />
                    <input type="hidden" name="amount" value="{{ $amount }}" />
                    <input type="hidden" name="url_notify" value="{{ $url_notify }}" />
                    <input type="hidden" name="url_return" value="{{ $url_return }}" />
                    <input type="submit" name="status" value="{{ $label_success }}" />
                    <input type="submit" name="status" value="{{ $label_denied }}" />
                </form>
            </div>
        </div>
    </div>
</body>

</html>