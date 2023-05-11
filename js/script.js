
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

//FAQ DROPDOWN
var acc = document.getElementsByClassName("FAQ_question");
var i;
for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var answer = this.nextElementSibling;
    if (answer.style.maxHeight) {
      answer.style.maxHeight = null;
    } else {
      answer.style.maxHeight = answer.scrollHeight + "px";
    } 
  });
}