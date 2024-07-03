
function buscarCliente() {
    var input = document.getElementById('buscador-input').value.trim().toLowerCase();
    var tabla = document.getElementById('tabla-pedidos');
    var rows = tabla.getElementsByTagName('tr');

    for (var i = 1; i < rows.length; i++) {
        var nombre = rows[i].getElementsByTagName('td')[0].textContent.trim().toLowerCase();
        if (nombre.includes(input)) {
            rows[i].style.display = '';
        } else {
            rows[i].style.display = 'none';
        }
    }
}
