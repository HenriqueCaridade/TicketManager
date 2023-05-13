
// PROFILE PIC CLICK
let profileHTML = document.getElementById('profile');
if (profileHTML !== null) {
    profileHTML.addEventListener('click', function(ev) {
        fetch('../pages/account.php', {
            method: 'POST',
        });
        document.location.pathname = '../pages/account.php';
    });
}
let profilesHTML = document.getElementsByClassName('profile');
for (let profile of profilesHTML) {
    profile.addEventListener('click', function(ev) {
        fetch('../pages/account.php', {
            method: 'POST',
            body: `username=${profileHTML.dataset.user}`,
        });
        document.location.pathname = '../pages/account.php';
    });
    
}

// CAPS LOCK WARNING
let loginForm = document.getElementById('login');
let registerForm = document.getElementById('register');
let capsWarning = document.getElementById('caps-warning');
if (capsWarning !== null) {
    if (loginForm !== null){
        loginForm.addEventListener("keyup", function(ev) {
            if (ev.getModifierState("CapsLock")) capsWarning.style.display = "block";
            else capsWarning.style.display = "none";
        });
    }
    if (registerForm !== null){
        registerForm.addEventListener("keyup", function(ev) {
            if (ev.getModifierState("CapsLock")) capsWarning.style.display = "block";
            else capsWarning.style.display = "none";
        });
    }
}

// SHOW PASSWORD
function toggleShowPasswords() {
    for (let element of document.getElementsByClassName('password'))
        element.type = element.type === 'password' ? 'text' : 'password';
}

// FAQ DROPDOWN
var elements = document.getElementsByClassName("faq-question");
for (let element of elements) {
    let parent = element.parentElement;
    let answerBlock = parent.getElementsByClassName("faq-answer-block")[0];
    let answer = answerBlock.getElementsByClassName("faq-answer")[0];
    answerBlock.style.maxHeight = 0; // Start Closed
    element.addEventListener("click", function() {
        parent.classList.toggle('faq-collapsed');
        if (parent.classList.contains('faq-collapsed')) {
            answerBlock.style.maxHeight = 0;
        } else {
            answerBlock.style.maxHeight = answer.clientHeight + 'px';
        }
    });
}

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
