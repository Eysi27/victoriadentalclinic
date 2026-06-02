function sortTable(headerCell) {
    const table = headerCell.closest("table");
    const tbody = table.tBodies[0];
    const headers = Array.from(headerCell.parentElement.children);
    const columnIndex = headers.indexOf(headerCell);
    const isAscending = headerCell.getAttribute("data-sort-dir") !== "asc";

    // Reset sort direction and icons on all headers
    headers.forEach(h => {
        h.removeAttribute("data-sort-dir");
        const icon = h.querySelector('.sort-icon');
        if (icon) icon.innerHTML = '';
    });

    // Set current direction and icon
    headerCell.setAttribute("data-sort-dir", isAscending ? "asc" : "desc");
    const icon = headerCell.querySelector('.sort-icon');
    if (icon) icon.innerHTML = isAscending ? '&#9650;' : '&#9660;'; // ▲ or ▼

    const rows = Array.from(tbody.rows);

    rows.sort((a, b) => {
        const cellA = a.cells[columnIndex].innerText.trim();
        const cellB = b.cells[columnIndex].innerText.trim();
        const valA = isNaN(cellA) ? cellA.toLowerCase() : parseFloat(cellA);
        const valB = isNaN(cellB) ? cellB.toLowerCase() : parseFloat(cellB);

        if (valA < valB) return isAscending ? -1 : 1;
        if (valA > valB) return isAscending ? 1 : -1;
        return 0;
    });

    rows.forEach(row => tbody.appendChild(row));
}