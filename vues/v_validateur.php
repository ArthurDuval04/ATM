<html>
<head>
    <title>Validation d'un utilisateur </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- styles -->
    <link href="css/styles.css" rel="stylesheet">
</head>
<body background="assets/img/laboratoire.jpg">
<div class="page-content container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<div class="login-wrapper">
				<div class="box">
					<div class="content-wrap">
						<legend>Valider un utilisateur</legend>
							<form method="post" action="index.php?uc=validateur&action=valider">
								<input name="email" class="form-control" type="mail" placeholder="E-mail">
								</br>
								<input type="submit" class="btn btn-primary signup" value="Valider l'utilisateur">
							</form>
                        <br/>           
                    </div>	
                                     
                                    
				</div>
			</div>
		</div>
	</div>
</div></body>
</html>