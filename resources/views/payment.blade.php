<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Descom Payment Demo</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #f2f2f2;

            margin: 0;
            padding: 1em;

            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .container {
            width: 100%;
            box-sizing: border-box;
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
        }

        header {
            text-align: center;
        }

        header h1 {
            font-size: 1.5rem;
            margin: 0;
        }

        header p {
            font-size: 0.8rem;
            margin: 0;
        }

        .resume {
            margin: 20px 0;
            text-align: center;
        }

        .resume h2 {
            font-size: 1.2rem;
            margin: 0;
        }

        .resume p {
            font-size: 0.8rem;
            margin: 0;
        }

        .resume span {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .form {
            text-align: center;
        }

        .form h2 {
            font-size: 1.2rem;
            margin: 0;
        }

        .form div {
            margin: 20px 0;
        }

        .form input[type="submit"] {
            font-size: 1rem;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            margin: 0 10px;
            cursor: pointer;
        }

        .form input[type="submit"]:first-child {
            background-color: #4caf50;
            color: #fff;
        }

        .form input[type="submit"]:last-child {
            background-color: #f44336;
            color: #fff;
        }
    </style>
</head>

<body>
    <div class="container">
        <header>
            <h1>Método de pago de transferencia bancaria</h1>
            <p>
                Este método de pago ha sido desarrollado por Descom para realizar procesos de compra por transferencia
                bancaria.
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
                    <input type="hidden" name="transaction_id" value="{{ $transactionId }}" />
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
