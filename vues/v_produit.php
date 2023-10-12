

  <body background="assets/img/laboratoire.jpg">
  <link rel="stylesheet" href="../css/styleproduit.css">

      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->

<div class="page-content container">
<h2 > voici les produits présentés : </h2>
    <h3> survoler les produits qui vous intéresses pour en apprendre plus</h3>

    <div class="flip-cards-container">
    <?php
   
   
    $lesProduits = $pdo->produit();
    foreach ($lesProduits as $row) {
        echo '<div class="flip-card">';
        echo '  <div class="flip-card-inner">';
        echo '    <div class="flip-card-front">';
        echo '      ' . $row["nom"];
        echo '      ' . '<img src="' . $row["effetIndesirable"] . '" alt="' . $row['nom'] . '" width="100">';
        echo '    </div>';
        echo '    <div class="flip-card-back">';
        echo '      <p>' . $row["objectif"] . '</p>';
        echo '      <a href="' . $row["information"] . '" target="_blank" class="bouton-lien">En savoir plus</a>';
        echo '    </div>';
        echo '  </div>';
        echo '</div>';
    }
    ?>
</div>



</div></div>

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>
  </body>
</html>