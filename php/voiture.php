<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/basic.css">
    <title>Document</title>
</head>
<body>
    <?php
    include 'header.html';
    ?>
    <form action="accueil.php" method="get">
        <p>date debut location</p>
        <input type="date">
        <p>date fin location</p>
        <input type="date">

        <input type="submit">
    </form>

    <?php
        include 'footer.html';
    ?>

</body>
</html>