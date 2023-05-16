
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

for (let client of document.getElementsByClassName('client-usertype-change')) {
    client.addEventListener('click', function(ev){
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function(){
            document.getElementById('popup').innerHTML = this.responseText;
            openPopup();
        };
        xhttp.open("POST", '../ajax/userTypePopup.php', false);
        xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhttp.send(`username=${client.dataset.username}&userType=${client.dataset.userType}`);
    });
}

for (let agent of document.getElementsByClassName('agent-usertype-change')) {
    agent.addEventListener('click', function(ev){
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function(){
            document.getElementById('popup').innerHTML = this.responseText;
            openPopup();
        };
        xhttp.open("POST", '../ajax/userTypePopup.php', false);
        xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhttp.send(`username=${agent.dataset.username}&userType=${agent.dataset.userType}`);
    });
}

for (let agent of document.getElementsByClassName('agent-department-change')) {
    agent.addEventListener('click', function(ev){
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function(){
            document.getElementById('popup').innerHTML = this.responseText;
            openPopup();
        };
        xhttp.open("POST", '../ajax/departmentPopup.php', false);
        xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhttp.send(`username=${agent.dataset.username}`);
    });
}

for (let ticket of document.getElementsByClassName('ticket-department-change')) {
    ticket.addEventListener('click', function(ev){
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function(){
            document.getElementById('popup').innerHTML = this.responseText;
            openPopup();
        };
        xhttp.open("POST", '../ajax/ticketDepartmentPopup.php', false);
        xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhttp.send(`id=${ticket.dataset.id}&department=${ticket.dataset.department}`);
    });
}