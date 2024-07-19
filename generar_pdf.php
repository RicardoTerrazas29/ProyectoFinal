<?php
include ('./library/tcpdf.php');

// Verificar si los datos están disponibles en el POST
$productos = isset($_POST['productos']) ? json_decode($_POST['productos'], true) : [];

// Crear nuevo documento PDF
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Información del documento
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Author');
$pdf->SetTitle('Venta');
$pdf->SetSubject('Detalles de Venta');
$pdf->SetKeywords('TCPDF, PDF, venta, ejemplo');

// Configurar encabezado y pie de página
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// Configurar márgenes
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// Configurar salto automático de página
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// Escala de imágenes
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// Añadir una página
$pdf->AddPage();

// Configurar fuente
$pdf->SetFont('times', 'B', 20);

// Título
$pdf->Cell(0, 15, 'Detalles de Venta', 0, 1, 'C');

// Configurar fuente
$pdf->SetFont('times', '', 12);

// Escribir datos
$html = '<h2>Información de la Venta</h2>';
$html .= '<table border="1" cellspacing="3" cellpadding="4">';
$html .= '<tr><th>ID</th><th>Descripción</th><th>Cantidad</th><th>Precio</th><th>Total</th></tr>';
foreach ($productos as $producto) {
    $html .= '<tr>';
    $html .= '<td>' . htmlspecialchars($producto['id']) . '</td>';
    $html .= '<td>' . htmlspecialchars($producto['descripcion']) . '</td>';
    $html .= '<td>' . htmlspecialchars($producto['cantidad']) . '</td>';
    $html .= '<td>' . htmlspecialchars($producto['precio']) . '</td>';
    $html .= '<td>' . htmlspecialchars($producto['total']) . '</td>';
    $html .= '</tr>';
}
$html .= '</table>';

// Salida del contenido HTML
$pdf->writeHTML($html, true, false, true, false, '');

// Cerrar y salida del documento PDF
$pdf->Output('venta.pdf', 'I');
?>
