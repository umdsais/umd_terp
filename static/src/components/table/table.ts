/**
 * Responsive table stacking — native replacement for Tablesaw stackonly.
 *
 * Reads column headers from <thead> and injects .tablesaw-cell-label /
 * .tablesaw-cell-content wrappers into each <td>, which the theme's
 * existing table.css uses to render the stacked mobile layout.
 */
function stackTable(table: HTMLTableElement): void {
  const headerCells = Array.from(table.querySelectorAll('thead th, thead td'));
  const headers = headerCells.map((th) => th.textContent?.trim() ?? '');

  if (!headers.length) return;

  table.querySelectorAll('tbody tr').forEach((row) => {
    Array.from(row.querySelectorAll('td')).forEach((cell, i) => {
      const label = document.createElement('b');
      label.className = 'tablesaw-cell-label';
      label.setAttribute('aria-hidden', 'true');
      label.textContent = headers[i] ?? '';

      const content = document.createElement('b');
      content.className = 'tablesaw-cell-content';
      while (cell.firstChild) {
        content.appendChild(cell.firstChild);
      }

      cell.appendChild(label);
      cell.appendChild(content);
    });
  });
}

export default function initTableStack(): void {
  document
    .querySelectorAll<HTMLTableElement>('[data-tablesaw-mode="stack"]')
    .forEach(stackTable);
}
