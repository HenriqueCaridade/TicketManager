
// PROFILE PIC CLICK
let profileHTML = document.getElementById('profile');
if (profileHTML !== null) {
    profileHTML.addEventListener('click', function(ev) {
        if (profileHTML.dataset.user === undefined) {
            fetch('../pages/account.php', {
                method: 'POST',
            });
        } else {
            fetch('../pages/account.php', {
                method: 'POST',
                body: `username=${profileHTML.dataset.user}`,
            });
        }
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
