<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<?php
if (!$_SESSION['id'])
    header('Location: ../index.php');
else {
  include "v_navChef.php";
}
?>
 <h1 class="mx-auto">Modifier les produits</h1>
<div class="mx-auto bg-white w-50 overflow-auto">
    <div class="row row-cols-1 row-cols-md-3 g-4 overflow-auto">
     
    <?php
     $lesProduits = $pdo->produitValides();
     foreach ($lesProduits as $row) {
        echo '<div class="col">
                 <div class="card p-5">
                            <img src="images/'.$row["img_name"].'" class="card-img-top w-20 h-20" alt="...">
                            <div class="card-body h-40">
                                <h4 class="card-title"><strong>'.$row["nom"].'</strong></h4>
                                <p class="card-text"><strong>Description : </strong>'.$row["information"].' </p>
                                <p class="card-text"><strong>Objectif du produit : </strong>'.$row["objectif"].' </p>
                                <p class="card-text"><strong>Effets indésirables : </strong>'.$row["effetIndesirable"].' </p>
                            </div>
                            <div class="mx-auto">
                                <a href="index.php?uc=produit&action=='.$row["id"].'" class="btn btn-success">Modifier</a>
                            </div>  

                        </div>
                
    
                </div>';
     }
            ?>

    </div>
</div>