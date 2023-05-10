<?php
    include_once("../templates/profile.php");
    function drawHeader(bool $drawProfile=false) {
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="../js/script.js" defer></script>
    <script src="https://kit.fontawesome.com/f3cf9d3f6c.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/style.css">
    <title>Tick.et</title>
</head>
<body>
    <header>
        <span id="logo">Tick.<span id="logo-highlight">et</span></span>
        <?php if ($drawProfile) drawProfile(); ?>
    </header>
<?php
    }
?>