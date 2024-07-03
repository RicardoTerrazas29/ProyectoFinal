
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
function buscarCompra() {
    var input = document.getElementById('buscador-Com').value.trim().toLowerCase();
    var tabla = document.getElementById('tabla-pedidos');
    var rows = tabla.getElementsByTagName('tr');

    for (var i = 1; i < rows.length; i++) {
        var compra = rows[i].getElementsByTagName('td')[1].textContent.trim().toLowerCase();
        if (compra.includes(input)) {
            rows[i].style.display = '';
        } else {
            rows[i].style.display = 'none';
        }
    }
}
function buscarPrecio() {
    var input = document.getElementById('buscador-Pre').value.trim().toLowerCase();
    var tabla = document.getElementById('tabla-pedidos');
    var rows = tabla.getElementsByTagName('tr');

    for (var i = 1; i < rows.length; i++) {
        var compra = rows[i].getElementsByTagName('td')[2].textContent.trim().toLowerCase();
        if (compra.includes(input)) {
            rows[i].style.display = '';
        } else {
            rows[i].style.display = 'none';
        }
    }
}
function buscarEst() {
    var input = document.getElementById('buscador-Es').value.trim().toLowerCase();
    var tabla = document.getElementById('tabla-pedidos');
    var rows = tabla.getElementsByTagName('tr');

    for (var i = 1; i < rows.length; i++) {
        var compra = rows[i].getElementsByTagName('td')[3].textContent.trim().toLowerCase();
        if (compra.includes(input)) {
            rows[i].style.display = '';
        } else {
            rows[i].style.display = 'none';
        }
    }
}
