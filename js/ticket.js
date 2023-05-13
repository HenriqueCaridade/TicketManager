
//NEW TICKET POPUP
function openTicketForm() {
    document.getElementById("popup-form").style.display = "block";
    document.getElementById("ticket-darken").style.display = "block";
}
function closeTicketForm() {
    document.getElementById("popup-form").style.display = "none";
    document.getElementById("ticket-darken").style.display = "none";
}
  
  // TICKET TABLE RESIZER 
const createResizableColumn = function (col, nextCol, resizer) {
    let x = 0;
    let colW = 0;
    let nextColW = 0;

    const mouseDownHandler = function (e) {
        x = e.clientX;
        const stylesCol = window.getComputedStyle(col);
        const stylesNext = window.getComputedStyle(nextCol);
        colW = parseInt(stylesCol.width, 10);
        nextColW = parseInt(stylesNext.width, 10);

        document.addEventListener('mousemove', mouseMoveHandler);
        document.addEventListener('mouseup', mouseUpHandler);
        resizer.classList.add('ticket-resizing');
    };

    const mouseMoveHandler = function (e) {
        const stylesCol = window.getComputedStyle(col);
        const stylesNext = window.getComputedStyle(nextCol);
        const dx = e.clientX - x;
        const newW = colW + dx;
        col.style.width = `${newW}px`;
        const realW = Math.ceil(parseFloat(stylesCol.width));
        const newNextW = nextColW + colW - realW;
        nextCol.style.width = `${newNextW}px`;
        const realNextW = Math.ceil(parseFloat(stylesNext.width));
        const newColW = (parseInt(nextCol.style.width, 10) <= realNextW) ? newW + nextColW + colW - newW - realNextW : newW + newNextW - realNextW;
        col.style.width = `${newColW}px`;
    };

    const mouseUpHandler = function () {
        document.removeEventListener('mousemove', mouseMoveHandler);
        document.removeEventListener('mouseup', mouseUpHandler);
        resizer.classList.remove('ticket-resizing');
    };

    resizer.addEventListener('mousedown', mouseDownHandler);
};

const table = document.getElementById('tickets');
if (table !== null) {
    const cols = table.querySelectorAll('th');
    for (let i = 0; i + 1 < cols.length; i++) {
        let col = cols[i];
        let nextCol = cols[i + 1];
        const resizer = document.createElement('div');
        resizer.classList.add('ticket-resizer');
        resizer.style.height = `${table.offsetHeight}px`;
        col.appendChild(resizer);

        createResizableColumn(col, nextCol, resizer);
    }
}

let tickets = document.getElementsByClassName('ticket');
for (let ticket of tickets) {
    ticket.querySelector('.ticket-subject').addEventListener('click', function(ev) {
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
            document.querySelector('main').innerHTML = this.responseText;
        }
        xhttp.open("POST", "../ajax/ticket.php", false);
        xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhttp.send(`id=${ticket.dataset.id}`);
    });
}