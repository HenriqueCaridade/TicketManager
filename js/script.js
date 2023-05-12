
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
console.log(loginForm, registerForm, capsWarning);
if (capsWarning !== undefined) {
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
  document.getElementById("popupForm").style.display = "block";
}
function closeTicketForm() {
  document.getElementById("popupForm").style.display = "none";
}
