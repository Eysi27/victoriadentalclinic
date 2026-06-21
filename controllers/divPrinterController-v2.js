function printDiv(divName) {
    var divToPrint = document.getElementById(divName);
    if (!divToPrint) return;

    var printWindow = window.open('', '_blank');
    printWindow.document.write(`
        <html>
        <head>
            <title>Print Payroll</title>
            <link href="css/sb-admin-2.min.css" rel="stylesheet" type="text/css">
            <style>
                @page { margin: 8mm; size: auto; }
                html, body { margin: 0; padding: 0; min-height: 100%; }
                body { background: #fff; color: #000; font-family: Arial, sans-serif; }
                .card, .card-body, .border { box-shadow: none !important; }
                .table { width: 100% !important; border-collapse: collapse !important; }
                .table th, .table td { padding: 0.35rem !important; border: 1px solid #dee2e6 !important; font-size: 0.78rem !important; }
                .table th { font-size: 0.8rem !important; }
                .no-print, .no-print * { display: none !important; }
                .print-area { width: 100%; }
            </style>
        </head>
        <body onload="window.print(); window.close();">
            <div class="print-area">
                ${divToPrint.outerHTML}
            </div>
        </body>
        </html>
    `);
    printWindow.document.close();
}
