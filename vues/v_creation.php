﻿<!DOCTYPE html>
<html lang="fr">
<head>
    <title>GSB -extranet</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- styles -->
    <link href="css/styles.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>

  <body background="assets/img/laboratoire.jpg">

      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->

<div class="page-content container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<div class="login-wrapper">
				<div class="box">
						
          <div class="content-wrap">
						<legend>je suis médecin, je souhaite créer un compte</legend>
							<form method="post" action="index.php?uc=creation&action=valideCreation">
              <input name="login" class="form-control" type="email" placeholder="mail"/>
                <input name="mdp" class="form-control" type="password" placeholder="password"/>
                <input name="prenom" class="form-control" type="text" placeholder="prénom"/>
                <input name="nom" class="form-control" type="text" placeholder="nom"/>
                <input name="numerodetelephone" class="form-control" type="tel" placeholder="numéro de téléphone"/>
                <input name="RPPS" class="form-control" type="text" placeholder="RPPS"/>
                <label for="Datedenaissance">date de naissance</label>
                <input name="datenaissance" class="form-control" type="date" placeholder="Date de naissance"/>
                <label for="Datedediplome">date de diplome</label>
                <input name="Datedediplome" class="form-control" type="date" placeholder="Date de diplôme"/>
								<br>
                <div class="form-check">
                    <input name ="acceptepolitquecheckbox" class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                      J'atteste avoir lu et accepte notre <button name="buttonconditions"style = "border:none; background-color:white;"><a target ="_blank" href="vues/v_politiqueprotectiondonnees.html">politique de protection des donnees.</a></button>
                    </label>
                </div>
                  <input type="submit" class="btn btn-primary signup" value="Créer"/>
							</form>
							</br>
						
					</div>	
				</div>
			</div>
		</div>
	</div>
</div>

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="js/custom.js"></script>
  </body>
</html>