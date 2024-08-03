<?php
include ('./library/tcpdf.php');

class MYPDF extends TCPDF {
    // Sobrescribir el método Header
    public function Header() {
        // Establecer la fuente
        $this->SetFont('helvetica', 'B', 16);
        // Título
        $this->Cell(0, 10, 'TechCompany - Reporte de Venta', 0, 1, 'C');
        // Línea horizontal
        $this->SetLineWidth(0.5);
        $this->Line(10, 20, 200, 20);
        $this->Ln(10); // Espacio después del encabezado
    }

    // Sobrescribir el método Footer
    public function Footer() {
        $this->SetY(-15);
        $this->SetFont('helvetica', 'I', 8);
        $this->Cell(0, 10, 'Página '.$this->getAliasNumPage().' de '.$this->getAliasNbPages(), 0, 0, 'C');
    }
}

// Verificar si los datos están disponibles en el POST
$productos = isset($_POST['productos']) ? json_decode($_POST['productos'], true) : [];

// Crear nuevo documento PDF
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// Información del documento
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('TechCompany');
$pdf->SetTitle('Reporte de Venta');
$pdf->SetSubject('Reporte de Venta');

// Establecer márgenes
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP + 10, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// Establecer la fuente
$pdf->SetFont('helvetica', '', 12);

// Agregar una página
$pdf->AddPage();

// Contenido HTML
$html = '<h2 style="text-align:center;">Información de la Venta</h2>';
$html .= '<table border="1" cellspacing="0" cellpadding="5" style="border-collapse:collapse; width:100%;">';
$html .= '<tr style="background-color:#f2f2f2; font-weight:bold; text-align:center;">
            <th>ID</th>
            <th>Cliente</th>
            <th>Descripción</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Total</th>
          </tr>';

$totalVenta = 0;

foreach ($productos as $producto) {
    $html .= '<tr>';
    $html .= '<td style="text-align:center;">' . htmlspecialchars($producto['id']) . '</td>';
    $html .= '<td>' . htmlspecialchars($producto['cliente']) . '</td>';
    $html .= '<td>' . htmlspecialchars($producto['descripcion']) . '</td>';
    $html .= '<td style="text-align:right;">' . htmlspecialchars($producto['cantidad']) . '</td>';
    $html .= '<td style="text-align:right;">' . htmlspecialchars($producto['precio']) . '</td>';
    $html .= '<td style="text-align:right;">' . htmlspecialchars($producto['total']) . '</td>';
    $html .= '</tr>';
    $totalVenta += $producto['total'];
}

$html .= '<tr>';
$html .= '<td colspan="5" style="text-align:right; font-weight:bold;">Total Venta:</td>';
$html .= '<td style="text-align:right; font-weight:bold;">' . htmlspecialchars($totalVenta) . '</td>';
$html .= '</tr>';

$html .= '</table>';

// Salida del contenido HTML
$pdf->writeHTML($html, true, false, true, false, '');

// Cerrar y enviar el PDF al navegador
$pdf->Output('reporte_venta.pdf', 'I');
?>
