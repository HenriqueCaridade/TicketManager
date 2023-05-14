// PROFILE PIC CLICK
let profilesHTML = document.getElementsByClassName('profile');
for (let profile of profilesHTML) {
    profile.addEventListener('click', function(ev) {
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function(){
            document.querySelector('main').innerHTML = this.responseText;
        };
        xhttp.open("POST", '../ajax/account.php', false);
        xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhttp.send(`username=${profile.dataset.user}`);
    });
}
