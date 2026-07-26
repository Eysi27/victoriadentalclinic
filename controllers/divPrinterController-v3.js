function printDiv(divName) {
    var divToPrint = document.getElementById(divName);
    if (!divToPrint) return;

    // Clone the element
    var clone = divToPrint.cloneNode(true);

    // Copy current values of all form controls
    var originalControls = divToPrint.querySelectorAll("input, textarea, select");
    var cloneControls = clone.querySelectorAll("input, textarea, select");

    originalControls.forEach(function (control, index) {
        var cloneControl = cloneControls[index];

        if (!cloneControl) return;

        switch (control.tagName.toLowerCase()) {
            case "input":
                if (control.type === "checkbox" || control.type === "radio") {
                    cloneControl.checked = control.checked;

                    if (control.checked) {
                        cloneControl.setAttribute("checked", "checked");
                    } else {
                        cloneControl.removeAttribute("checked");
                    }
                } else {
                    cloneControl.value = control.value;
                    cloneControl.setAttribute("value", control.value);
                }
                break;

            case "textarea":
                cloneControl.value = control.value;
                cloneControl.textContent = control.value;
                break;

            case "select":
                cloneControl.value = control.value;

                Array.from(cloneControl.options).forEach(function (option) {
                    option.selected = option.value === control.value;
                });
                break;
        }
    });

    // Open print window
    var printWindow = window.open("", "_blank");

    printWindow.document.write(`
        <!DOCTYPE html>
        <html>
        <head>
            <title>Print Payroll</title>

            <link href="css/sb-admin-2.min.css" rel="stylesheet">

            <style>
                @page {
                    margin: 8mm;
                    size: auto;
                }

                html, body {
                    margin: 0;
                    padding: 0;
                    background: #fff;
                    color: #000;
                    font-family: Arial, sans-serif;
                }

                .card,
                .card-body,
                .border {
                    box-shadow: none !important;
                }

                .table {
                    width: 100% !important;
                    border-collapse: collapse !important;
                }

                .table th,
                .table td {
                    padding: 0.35rem !important;
                    border: 1px solid #dee2e6 !important;
                    font-size: 0.78rem !important;
                }

                .table th {
                    font-size: 0.8rem !important;
                }

                .no-print,
                .no-print * {
                    display: none !important;
                }

                .print-area {
                    width: 100%;
                }
            </style>
        </head>

        <body>
            <div class="print-area"></div>
        </body>
        </html>
    `);

    printWindow.document.close();

    // Append the cloned DOM (preserves current values)
    printWindow.document.querySelector(".print-area").appendChild(clone);

    // Wait for styles to load before printing
    printWindow.onload = function () {
        printWindow.focus();
        printWindow.print();
        printWindow.close();
    };
}