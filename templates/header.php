<?php
    include_once("../templates/profile.php");
    include_once("../classes/session.php");
    function drawHeader(bool $drawProfile=false) {
        $session = Session::getSession();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../js/faq.js" defer></script>
    <script src="../js/profile.js" defer></script>
    <script src="../js/ticket.js" defer></script>
    <script src="../js/userForms.js" defer></script>
    <script src="../js/popups.js" defer></script>
    <script src="https://kit.fontawesome.com/f3cf9d3f6c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/include.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/account.css">
    <link rel="stylesheet" href="../css/faq.css">
    <link rel="stylesheet" href="../css/button.css">
    <link rel="stylesheet" href="../css/userForms.css">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/popup.css">
    <link rel="stylesheet" href="../css/table.css">
    <title>Tick.et</title>
</head>
<body>
    <header>
        <span id="logo">Tick.<span id="logo-highlight">et</span></span>
        <div id="profile" class="profile" data-user="<?=htmlentities($_SESSION[Session::USERNAME])?>">
            <i class="fa-solid fa-circle-user"></i>
        </div>
    </header>
<?php
    }
?>