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
