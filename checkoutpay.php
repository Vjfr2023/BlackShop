<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> BlackShop </title>

</head>
<body>

        
 <!-- Asignamos un Id a nuestro boton -->
 <div id="paypal-button-container"></div>

<!-- Incluimos el PayPal JavaScript SDK y id= client id de Paypal Empresa -->
<script src="https://www.paypal.com/sdk/js?client-id=AQ27SRh7hBQZqj7mbqCvosrfLUMpSmKPQs-6ih_MgUKYRDCRPpgYxDU7USEYpGfzTFS9SYTN-GrZ7_In&currency=USD"></script>

<script>
    // Comenzamos a Programar y a darle estilo a nuestro boton de Paypal JavaScript SDK
    paypal.Buttons({
        style:{
            color: 'blue',
            shape: 'pill',
            label: 'pay'
        },

        // El Valor que tendra nuestro producto el cual se selecciono para la venta
        createOrder: function(data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: 100
                    }
                }]
            });
        },


        // Finaliza el proceso anterior e inicia al captura de fondos
        onApprove: function(data, actions) {
            return actions.order.capture().then(function(orderData) {
                // Captura de Fondos Completada! For demo purposes:
                console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                var transaction = orderData.purchase_units[0].payments.captures[0];
                alert('Transaction '+ transaction.status + ': ' + transaction.id + '\n\nSee console for all available details');

                // Replace the above to show a success message within this page, e.g.
                // const element = document.getElementById('paypal-button-container');
                // element.innerHTML = '';
                // element.innerHTML = '<h3>Thank you for your payment!</h3>';
                // Or go to another URL:  actions.redirect('thank_you.html');
            });
        },
        
        oncancel: function(data){
            alert("Pago cancelado");
            console.log(data);
        }


    }).render('#paypal-button-container');
</script>


</body>
</html>