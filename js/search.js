
const userSearch = document.getElementById('user-search');
const departmentSearch = document.getElementById('department-search');
if (userSearch !== null){
    userSearch.addEventListener('change', function(ev) {
        const xhttp1 = new XMLHttpRequest();
        xhttp1.onload = function() {
            document.getElementById('client-table').innerHTML = this.responseText;
            const xhttp2 = new XMLHttpRequest();
            xhttp2.onload = function() {
                document.getElementById('agent-table').innerHTML = this.responseText;
                createResizableTables();
            };
            xhttp2.open("POST", '../ajax/agentTable.php', false);
            xhttp2.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhttp2.send(`query=${ev.target.value}`);
        };
        xhttp1.open("POST", '../ajax/clientTable.php', false);
        xhttp1.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhttp1.send(`query=${ev.target.value}`);
    });
}
if (departmentSearch !== null){
    departmentSearch.addEventListener('change', function(ev) {
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function() {
            document.getElementById('department-tables').innerHTML = this.responseText;
            createResizableTables();
        };
        xhttp.open("POST", '../ajax/departmentTables.php', false);
        xhttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhttp.send(`query=${ev.target.value}`);
    });
}
