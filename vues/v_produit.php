

<?php 
  include("v_sommaire.php");

?>


  <body background="assets/img/laboratoire.jpg">
  <link rel="stylesheet" href="css/styleproduit.css">
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->

<div class="container">
<h2 > Voici les produits présentés : </h2>
    <div class="flip-cards-container">
    <?php
    $lesProduits = $pdo->produitValides();
    foreach ($lesProduits as $row) {

        echo '<div class="flip-card">
          <div class="flip-card-inner text-center bg-white">
            <div class="flip-card-front">
              <img class="produitImg" src="images/' . $row["img_name"] . '" alt="' . $row['nom'] . '" width="100">
              <h3 class="titleProduit">' . $row["nom"] .'</h3>
              <p> Effets indésirables : <strong>'. $row["objectif"] . '</strong></p>
              <p> Informations : <strong>'. $row["information"] . '</p>
            </div>
          </div>
        </div>';
    }
    ?>
    </div>
</div>



</div></div>

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>
  </body>
</html>