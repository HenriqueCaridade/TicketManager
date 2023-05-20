
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

for (let user of document.getElementsByClassName('usertype-change')) {
    user.addEventListener('click', function(ev){
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function(){
            document.getElementById('popup').innerHTML = this.responseText;
            openPopup();
        };
        xhttp.open("POST", '../ajax/userTypePopup.php', false);
        xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhttp.send(`username=${user.dataset.username}&userType=${user.dataset.userType}`);
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

for (let ticket of document.getElementsByClassName('ticket-priority-change')) {
    ticket.addEventListener('click', function(ev){
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function(){
            document.getElementById('popup').innerHTML = this.responseText;
            openPopup();
        };
        xhttp.open("POST", '../ajax/ticketPriorityPopup.php', false);
        xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhttp.send(`id=${ticket.dataset.id}&priority=${ticket.dataset.priority}`);
    });
}


for (let ticket of document.getElementsByClassName('ticket-status-change')) {
    ticket.addEventListener('click', function(ev){
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function(){
            document.getElementById('popup').innerHTML = this.responseText;
            openPopup();
        };
        console.log(ticket.dataset);
        xhttp.open("POST", '../ajax/ticketStatusPopup.php', false);
        xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhttp.send(`id=${ticket.dataset.id}&status=${ticket.dataset.status}`);
    });
}

const departmentAdd = document.getElementById('department-add-button');
const departmentRemove = document.getElementById('department-remove-button');
if (departmentAdd !== null && departmentRemove !== null) {
    departmentAdd.addEventListener('click', function() {
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function(){
            document.getElementById('popup').innerHTML = this.responseText;
            openPopup();
        };
        xhttp.open("POST", '../ajax/addDepartmentPopup.php', false);
        xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhttp.send();
    });
    departmentRemove.addEventListener('click', function() {
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function(){
            document.getElementById('popup').innerHTML = this.responseText;
            openPopup();
        };
        xhttp.open("POST", '../ajax/removeDepartmentPopup.php', false);
        xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhttp.send();
    });
}


const userFilters = document.getElementById('user-filters');
if (userFilters !== null) {
    userFilters.addEventListener('click', function() {
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function(){
            document.getElementById('popup').innerHTML = this.responseText;
            openPopup();
        };
        xhttp.open("POST", '../ajax/userFiltersPopup.php', false);
        xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhttp.send();
    });
}
const departmentFilters = document.getElementById('department-filters');
if (departmentFilters !== null) {
    departmentFilters.addEventListener('click', function() {
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function(){
            document.getElementById('popup').innerHTML = this.responseText;
            openPopup();
        };
        xhttp.open("POST", '../ajax/departmentFiltersPopup.php', false);
        xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhttp.send();
    });
}
