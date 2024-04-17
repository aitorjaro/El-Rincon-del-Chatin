//Animaciones categorías
$(document).ready(function () {
document.querySelectorAll('.botonCategorias').forEach(btn => {
    btn.addEventListener('click', function() {
      let categoria = this.getAttribute('data-categoria');
      let productos = document.querySelectorAll('.articulo');
  
      productos.forEach(prod => {
        if(prod.getAttribute('data-categoria') === categoria || categoria === 'todos') {
          prod.style.display = 'block';
          prod.style.animation = 'fadeInScale 0.5s ease';
        } else {
          prod.style.display = 'none';
        }
      });
    });
  });
});
//Carrito con Ajax
  $(document).ready(function () {
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
    $('.carrito').on('click', function() {
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
});

//Menú desplegable
document.querySelector(".bars__menu").addEventListener("click", mostrarMenu);
var line1__bars = document.querySelector(".line1__bars-menu");
var line2__bars = document.querySelector(".line2__bars-menu");
var line3__bars = document.querySelector(".line3__bars-menu");

var menuEntero = document.getElementById("menuPrincipal");
var links = document.getElementsByClassName("menu");

function mostrarMenu(){
    line1__bars.classList.toggle("activeline1__bars-menu");
    line2__bars.classList.toggle("activeline2__bars-menu");
    line3__bars.classList.toggle("activeline3__bars-menu");
    menuEntero.classList.toggle("menu");
    menuEntero.classList.toggle("mostrarMenu");
    

for (var i = 0; i < links.length; i++) {
    links[i].addEventListener("click", function() {
      // Ocultar el menú
      line1__bars.classList.toggle("activeline1__bars-menu");
    line2__bars.classList.toggle("activeline2__bars-menu");
    line3__bars.classList.toggle("activeline3__bars-menu");
      menuEntero.classList.toggle("menu");
      menuEntero.classList.toggle("mostrarMenu");
    });
  }
}