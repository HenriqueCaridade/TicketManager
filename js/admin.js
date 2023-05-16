
function openPopup() {
    document.getElementById("popup").style.display = "block";
    document.getElementById("popup-darken").style.display = "block";
    document.getElementById("popup-form").style.display = "block";
}

function closePopup() {
    document.getElementById("popup").style.display = "none";
    document.getElementById("popup-darken").style.display = "none";
    document.getElementById("popup-form").style.display = "none";
}

let clientsChangeHTML = document.getElementsByClassName('client-change');
for (let client of clientsChangeHTML) {
    client.addEventListener('click', function(ev){
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function(){
            document.getElementById('popup').innerHTML = this.responseText;
            openPopup();
        };
        xhttp.open("POST", '../ajax/popup.php', false);
        xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhttp.send(`username=${client.dataset.username}&userType=${client.dataset.userType}`);
    });
}

let agentsChangeHTML = document.getElementsByClassName('agent-change');
for (let agent of agentsChangeHTML) {
    agent.addEventListener('click', function(ev){
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function(){
            document.getElementById('popup').innerHTML = this.responseText;
            openPopup();
        };
        xhttp.open("POST", '../ajax/popup.php', false);
        xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhttp.send(`username=${agent.dataset.username}&userType=${agent.dataset.userType}`);
    });
}