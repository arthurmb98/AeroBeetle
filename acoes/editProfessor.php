<?php
include"../seguranca/seguranca.php";

?>

<html lang="pt-br">
<head>
  <title>Cadastro de Professor</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link href="../estilo/estilo.css" rel="stylesheet" type="text/css" media="all">
</head>


<body>
<div class="col-sm-10">
  <a href="sair.php"><button type="button" class="btn btn-primary" name="submit" id="botao_sair">Voltar</button></a>  
</div> 
<div class="container" id="formDiv">
<form role="form" class="form-horizontal" action="CadProfessor.php" method="post"> 
    <div class="modal-header"></div>
        <div class="form-group">
            <label for="nome" class="col-sm-2">Nome</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome Professor" required>
            </div>
        </div>
      

        <div class="modal-footer">
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary" name="submit" id="botao_cadastro">Enviar</button>
            </div>
        </div>
      </div>
      </form>
</div>

</body>
</html>
