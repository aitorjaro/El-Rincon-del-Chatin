document.getElementById('categoria').addEventListener('change', function() {
  var categoriaId = this.value;
  var xhr = new XMLHttpRequest();
  xhr.open('GET', 'obtener_productos.php?categoria=' + categoriaId, true);
  xhr.onload = function() {
    if (this.status == 200) {
      document.getElementById('productos').innerHTML = this.responseText;
    }
  };
  xhr.send();
});
