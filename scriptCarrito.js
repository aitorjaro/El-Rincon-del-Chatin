 //Carrito con Ajax
 $('.formularioProducto').submit(function (e) {
    e.preventDefault();
    $.ajax({
      type: 'POST',
      url: '/index.php/carrito',
      data: $(this).serialize(), // Serializa los datos del formulario
      success: function (response) {
        $('#cantidadCarrito').text(response);
        console.log(response);
      }
    });

  });

  //Animaciones carrito
  $('.carrito').on('click', function () {
    var boton = $(this); // Guarda la referencia al botón
    var textoOriginal = boton.text(); // Guarda el texto original del botón
    boton.text('¡Producto añadido!'); // Añade la clase y cambia el texto
    setTimeout(() => {
      boton.removeClass('added').text(textoOriginal);
    }, 1000);
    $('.imagenCarroFija').css('animation', '');
    $('.imagenCarroFija').attr('src', '/imagenes/carro-de-la-compra-marron.png');

    setTimeout(function () {
      $('.imagenCarroFija').css('animation', 'moveToCart 1s');
    }, 10);

    setTimeout(function () {
      $('.imagenCarroFija').attr('src', '/imagenes/carro-de-la-compra.png');
    }, 1000);
  });