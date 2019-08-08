<!DOCTYPE html>
<html lang="pt-br">
<head>
 <meta charset="utf-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <title>Adicionar Aluno</title>

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
  
  <h3 class="page-header">Adicionar Aluno</h3>
  
  <form action="../acoes/CadAluno.php"  method="post">
  	<div class="row">
  	  <div class="form-group col-md-4">
  	  	<label for="nome">Nome</label>
  	  	<input type="name" class="form-control" name="nome" id="nome" placeholder="Nome Completo do Aluno" required>
  	  </div>
	  <div class="form-group col-md-4">
  	  	<label for="matricula">Matricula/CPF</label>
  	  	<input type="number" class="form-control" name="matricula" id="matricula" placeholder="Digite o Número de Matricula ou CPF">
  	  </div>
	  <div class="form-group col-md-4">
  	  	<label for="email">Email</label>
  	  	<input type="email" class="form-control" name="email" id="email" placeholder="Endereço de Email" required>
  	  </div>
	</div>
	
	<div class="row">
  	  <div class="form-group col-md-4">
  	  	<label for="telefone">Telefone</label>
  	  	<input type="number" class="form-control" name="telefone" id="telefone" placeholder="ex: 98988776655">
  	  </div>
	  <div class="form-group col-md-4">
  	  	<label for="periodo">Periodo</label>
  	  	<input type="number" max="12" class="form-control" name="periodo" id="periodo" placeholder="Digite o valor">
  	  </div>
      <div class="form-group col-md-4">
		<label for="graduacao">Graduação</label>
              <select class="form-control" name="graduacao" id="graduacao">
              <option>Nenhum</option>
              <option value = "1">Engenharia</option>
              <?php ?>
              </select> 
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