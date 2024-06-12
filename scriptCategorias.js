//Animaciones categorías
$(document).ready(function () {
  $('.botonCategorias').click(function () {
    let categoria = $(this).data('categoria');

    $.ajax({
      url: '/servidorAjaxCategorias.php',
      type: 'GET',
      data: { categoria: categoria }, // Enviamos la categoría al servidor
      dataType: 'json',
      success: function (articulos) {
        console.log(articulos);
        // Limpiamos la sección de artículos
        $('.articulos').empty();

        // Iteramos sobre el array de artículos y los agregamos al DOM
        articulos.forEach(function (articulo) {
          function hexToBase64(imagenHex) {
            var binario = '';
            for (var i = 0; i < imagenHex.length; i += 2) {
                binario += String.fromCharCode(parseInt(imagenHex.substr(i, 2), 16));
            }
            return window.btoa(binario);
        }
        
        $('.articulos').append(
          '<section class="articulo" data-categoria="' + articulo.categoria + '">' +
          '    <section class="englobarImagenArticulo">' +
          '        <a href="index.php/articulo?id=' + articulo.id + '">' +
          '            <img class="imagenArticulo" src="data:image/jpeg;base64,' + hexToBase64(articulo.imagen) + '">' +
          '        </a>' +
          '    </section>' +
          '    <br>' +
          '    <section class="englobarTextoArticulo">' +
          '        <section class="englobarTextoArticulo2">' +
          '            <section class="seccionCentrarTextoLista">' +
          '                <a class="titulo" href="index.php/articulo?id=' + articulo.id + '">' +
          '                    ' + articulo.nombre +
          '                </a>' +
          '                <p class="precio">' +
          '                    ' + articulo.precio + '€' +
          '                    <span class="iva">&nbsp;IVA incluido</span>' +
          '                </p>' +
          (articulo.agotado == 0 ?
          '                <form class="formularioProducto" action="/index.php/carrito" method="post">' +
          '                    <input name="idArticulo" type="hidden" value="' + articulo.id + '" />' +
          '                    <input name="cantidadArticulo" type="hidden" value="1" />' +
          '                    <button type="submit" class="carrito">Añadir al carrito</button>' +
          '                </form>' :
          '                    <p>Producto agotado</p>') +
          '            </section>' +
          '        </section>' +
          '    </section>' +
          '</section>'
        );
        });
      },
      error: function (xhr, status, error) {
        console.error("Error en la petición AJAX: " + status + "\nDetalles: " + error);
      }
    });

    if (window.matchMedia("(max-width: 767px)").matches) {
      let scrollPosition = window.pageYOffset || document.documentElement.scrollTop;
      let maxScroll = 300;
      let scrollValue = maxScroll - scrollPosition * 0.1;

      if (scrollValue < 0) {
        scrollValue = 0;
      }

      window.scrollTo({
        top: scrollPosition + scrollValue,
        behavior: 'smooth'
      });
    }
  });
});


