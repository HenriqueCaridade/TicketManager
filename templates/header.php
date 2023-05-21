<?php
    require_once(dirname(__DIR__) . "/templates/profile.php");
    require_once(dirname(__DIR__) . "/classes/session.php");
    function drawHeader(bool $drawProfile=true) {
        $session = Session::getSession();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../js/faq.js" defer></script>
    <script src="../js/ticket.js" defer></script>
    <script src="../js/userForms.js" defer></script>
    <script src="../js/popups.js" defer></script>
    <script src="../js/search.js" defer></script>
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
    <link rel="stylesheet" href="../css/search.css">
    <link rel="stylesheet" href="../css/ticket.css">
    <link rel="stylesheet" href="../css/change.css">
    <link rel="stylesheet" href="../css/mobile.css">
    <title>Tick.et</title>
</head>
<body>
    <header>
        <span id="logo">Tick.<span id="logo-highlight">et</span></span>
        <?php if ($drawProfile) { ?>
            <form class="profile-form" action="./index.php" method="get">
                <input type="hidden" name="page" value="account">
                <input type="hidden" name="username" value="<?=$_SESSION[Session::USERNAME]?>">
                <button type='submit' class="profile-submit"><i class="fa-solid fa-circle-user"></i></button>
            </form>
        <?php } ?>
    </header>
<?php
    }
?>