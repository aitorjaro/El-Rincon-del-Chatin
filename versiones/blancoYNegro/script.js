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