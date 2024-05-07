
    // Delegación de eventos para manejar el submit de cualquier formulario con la clase 'formularioProducto'
    $(document).on('submit', '.formularioProducto', function(e) {
        e.preventDefault();
        var form = $(this);
        $.ajax({
            type: 'POST',
            url: '/index.php/carrito',
            data: form.serialize(), // Serializa los datos del formulario
            success: function(response) {
                $('#cantidadCarrito').text(response);
                console.log(response);
            }
        });
    });

    // Delegación de eventos para manejar el click en cualquier botón con la clase 'carrito'
    $(document).on('click', '.carrito', function() {
        var boton = $(this); // Guarda la referencia al botón
        var textoOriginal = boton.text(); // Guarda el texto original del botón
        boton.text('¡Producto añadido!'); // Cambia el texto
        setTimeout(() => {
            boton.text(textoOriginal);
        }, 1000);
        $('.imagenCarroFija').css('animation', '');
        $('.imagenCarroFija').attr('src', '/imagenes/carro-de-la-compra-marron.png');

        setTimeout(function() {
            $('.imagenCarroFija').css('animation', 'moveToCart 1s');
        }, 10);

        setTimeout(function() {
            $('.imagenCarroFija').attr('src', '/imagenes/carro-de-la-compra.png');
        }, 1000);
    });