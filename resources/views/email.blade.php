<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmació de Compra d'Entrades</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #4CAF50;
            color: #ffffff;
            padding: 10px 0;
            text-align: center;
        }
        .content {
            padding: 20px;
        }
        .content h1 {
            color: #333333;
        }
        .content p {
            color: #666666;
        }
        .footer {
            text-align: center;
            padding: 10px;
            background-color: #f4f4f4;
            color: #666666;
            font-size: 12px;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            color: #ffffff;
            background-color: #4CAF50;
            text-decoration: none;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Confirmació de Compra d'Entrades</h2>
        </div>
        @if ($results->isNotEmpty())
        @php
            $firstResult = $results->first();
        @endphp
        @endif
        <div class="content">
            <h1>Gràcies per la teva compra!</h1>
            <p>Hola {{ $firstResult->order_userName }},</p>
            <p>Gràcies per comprar les teves entrades amb nosaltres. Aquí tens els detalls de la teva compra:</p>
            <ul>
                <li><strong>Esdeveniment:</strong> {{ $firstResult->event_name }}</li>
                <li><strong>Data:</strong> {{ $firstResult->event_date }} {{$firstResult->event_time}}</li>
               
                <li><strong>Entrades Comprades:</strong>  <table>
                    @foreach($results as $seat)
                    <tr><td>Fila {{$seat->seat_row}} Seient {{$seat->seat_col}}</td></tr>
                    @endforeach
                </table></li>
                <li><strong>Preu Total:</strong> {{count($results)*$firstResult->event_price}} €</li>
            </ul>
           
            <p>Pots accedir a les teves entrades i obtenir més informació fent clic en el botó següent: <a href="http://entrades.com">Aquí</a></p>
           
            <p>Si tens qualsevol pregunta, no dubtis a contactar-nos a entrades@entrades.com.</p>
            <p>Gràcies per confiar en nosaltres!</p>
            <p>Salutacions,</p>
          
        </div>
        <div class="footer">
            <p>&copy; 2024 . Tots els drets reservats.</p>
        </div>
    </div>
</body>
</html>