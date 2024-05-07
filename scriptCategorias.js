//Animaciones categorías
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
  
      // Calcula la posición actual en la página
      let scrollPosition = window.pageYOffset || document.documentElement.scrollTop;
      // Establece un valor máximo de desplazamiento
      let maxScroll = 300;
      // Calcula el desplazamiento proporcional a la posición en la página
      let scrollValue = maxScroll - scrollPosition * 0.1;
  
      // Asegúrate de que el desplazamiento no sea negativo
      if (scrollValue < 0) {
        scrollValue = 0;
      }
  
      // Desplazamiento suave hacia abajo basado en la posición actual
      window.scrollTo({
        top: scrollPosition + scrollValue,
        behavior: 'smooth'
      });
    });
  });
  
  
  
  