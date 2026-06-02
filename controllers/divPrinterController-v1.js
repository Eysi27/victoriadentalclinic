
function printDiv(divName) {
    var divToPrint = document.getElementById(divName);
    var newWindow = window.open('', '_blank');

    newWindow.document.write(`
        <html>
        <head>
            <title>Print</title>
            <style>
                @media print {
                    body {
                        margin: 0.5in;
                        font-family: Arial, sans-serif !important;
                        font-size: 8pt !important;
                        color: #000 !important;
                    }

                    table, th, td {
                        font-size: 8pt !important;
                    }

                    .table {
                        border-collapse: collapse !important;
                        width: 100% !important;
                    }

                    .table th, .table td {
                        padding: 4px !important;
                        border: 0px solid #000 !important;
                    }
                }
            </style>
        </head>
        <body onload="window.print(); window.close();">
            <div class="print-area">
                ${divToPrint.innerHTML}
            </div>
        </body>
        </html>
    `);

    newWindow.document.close();
}

