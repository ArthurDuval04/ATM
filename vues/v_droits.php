<!DOCTYPE html>

<?php
    include 'v_sommaire.php';
?>
<html lang="fr">

<head>
<title>GSB -extranet</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- styles -->
    <link href="css/styles.css" rel="stylesheet">
</head>
<body>

    <h1>Vous pouvez récupérer vos données a tout moment en cliquant <a href="https://s5-4257.nuage-peda.fr/projet/gsb/portabilite/<?php echo $_SESSION['id'].".json"?>" download>ici</a></h1>

</body>
</html>