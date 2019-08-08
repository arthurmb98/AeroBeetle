<!DOCTYPE html>
<html lang="pt-br">
<head>
 <meta charset="utf-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <title>Adicionar Palestrante</title>

 <link href="css/bootstrap.min.css" rel="stylesheet">
 <link href="css/style.css" rel="stylesheet">
 <link rel="shortcut icon" href="../logo1.jpeg">
</head>
<body>

 <nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
   <div class="navbar-header">
    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
     <span class="sr-only">Toggle navigation</span>
     <span class="icon-bar"></span>
     <span class="icon-bar"></span>
     <span class="icon-bar"></span>
    </button>
    <a class="navbar-brand" href="#">AeroBeetle</a>
   </div>
   <div id="navbar" class="navbar-collapse collapse">
    <ul class="nav navbar-nav navbar-right">
     <li><a href="../tela_inicial.php">In&iacute;cio</a></li>
     <li><a href="#">Op&ccedil;&otilde;es</a></li>
     <li><a href="#">Perfil</a></li>
     <li><a href="#">Ajuda</a></li>
    </ul>
   </div>
  </div>
 </nav>
 
 <div id="main" class="container-fluid">
  
  <h3 class="page-header">Adicionar Palestrante</h3>
  
  <form action="../acoes/CadPalestrante.php"  method="post">
  	<div class="row">
  	  <div class="form-group col-md-4">
  	  	<label for="nome">Nome</label>
  	  	<input type="name" class="form-control" name="nome" id="nome" placeholder="Nome Completo do Palestrante" required>
  	  </div>
	  <div class="form-group col-md-4">
  	  	<label for="matricula">CPF</label>
  	  	<input type="number" class="form-control" name="cpf" id="cpf" placeholder="Digite o Número de CPF">
  	  </div>
	</div>
	
	<div class="row">
	<div class="form-group col-md-4">
  	  	<label for="email">Email</label>
  	  	<input type="email" class="form-control" name="email" id="email" placeholder="Endereço de Email" required>
  	  </div>
  	  <div class="form-group col-md-4">
  	  	<label for="telefone">Telefone</label>
  	  	<input type="number" class="form-control" name="telefone" id="telefone" placeholder="ex: 98988776655">
  	  </div>
	</div>

	
	<div class="row">
	  <div class="col-md-12">
	  	<button type="submit" class="btn btn-primary">Salvar</button>
		<a href="template.html" class="btn btn-default">Cancelar</a>
	  </div>
	</div>

  </form>
 </div>
 

 <script src="js/jquery.min.js"></script>
 <script src="js/bootstrap.min.js"></script>
</body>
</html>