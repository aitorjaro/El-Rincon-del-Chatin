//Animaciones categorías
/*
document.addEventListener('DOMContentLoaded', (event) =>{
  document.querySelectorAll('.botonCategorias').forEach(btn => {
    btn.addEventListener('click', function () {
      let categoria = this.getAttribute('data-categoria');
      let productos = document.querySelectorAll('.articulo');

      productos.forEach(prod => {
        if (prod.getAttribute('data-categoria') === categoria || categoria === 'todos') {
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
  });*/

//Menú desplegable
document.querySelector(".bars__menu").addEventListener("click", mostrarMenu);
/*var line1__bars = document.querySelector(".line1__bars-menu");
var line2__bars = document.querySelector(".line2__bars-menu");
var line3__bars = document.querySelector(".line3__bars-menu");*/

var menuEntero = document.getElementById("menuPrincipal");

function mostrarMenu() {
  /* line1__bars.classList.toggle("activeline1__bars-menu");
   line2__bars.classList.toggle("activeline2__bars-menu");
   line3__bars.classList.toggle("activeline3__bars-menu");*/
  menuEntero.classList.add("mostrarMenu");
  menuEntero.classList.remove("ocultarMenu");
  document.body.classList.toggle('body-no-scroll');
}

document.querySelector("#imgXMenu").addEventListener("click", ocultarMenu);

function ocultarMenu() {
  menuEntero.classList.add("ocultarMenu");
  menuEntero.classList.remove("mostrarMenu");
  document.body.classList.remove('body-no-scroll');
}

//Menu lupa
document.querySelector(".divLupa").addEventListener("click", mostrarMenuLupa);
document.querySelector("#imagenLupa").addEventListener("click", mostrarMenuLupa);

function mostrarMenuLupa() {
  var menuLupa = document.getElementById("menuLupa");
  menuLupa.classList.add("mostrarBuscar");
  menuLupa.classList.remove("quitarBuscar");
  document.body.classList.add('body-no-scroll');
}

document.querySelector("#imgXBuscar").addEventListener("click", ocultarMenuLupa);
function ocultarMenuLupa() {
  var menuLupa2 = document.getElementById("menuLupa");
  menuLupa2.classList.add("quitarBuscar");
  menuLupa2.classList.remove("mostrarBuscar");
  document.body.classList.remove('body-no-scroll');
}

window.onscroll = function () { scrollFunction() };

function scrollFunction() {
  var scrollPosition = window.pageYOffset || document.documentElement.scrollTop;

  if (scrollPosition > 20) {
    document.getElementById("scrollToTopBtn").style.display = "block";
  } else {
    document.getElementById("scrollToTopBtn").style.display = "none";
  }
}

// Función para realizar el scroll hacia arriba
function scrollToTop() {
  window.scrollTo({ top: 0, behavior: 'smooth' });
}



