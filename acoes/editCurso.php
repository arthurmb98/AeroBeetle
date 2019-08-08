<?php
include"../seguranca/seguranca.php";

?>

<html lang="pt-br">
<head>
  <title>Cadastro de Curso</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link href="../estilo/estilo.css" rel="stylesheet" type="text/css" media="all">
  <link rel="shortcut icon" href="../logo1.jpeg">
</head>

<body>
<div class="col-sm-10">
  <a href=""><button type="button" class="btn btn-primary" name="submit" id="botao_sair">Voltar</button></a>  
</div> 
<div class="container" id="formDiv">
<form role="form" class="form-horizontal" action="CadCurso.php" method="post"> 
    <div class="modal-header"></div>
        <div class="form-group">
            <label for="nome" class="col-sm-2">Nome</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome Curso" required>
            </div>
        </div>
        <div class="form-group">
            <label for="carga_horaria" class="col-sm-2">Carga Horária</label>
            <div class="col-sm-4">
              <input type="number" max="999" class="form-control" name="carga_horaria" id="carga_horaria" placeholder="Ch Curso" required>
            </div>
        </div>
        <div class="form-group">
             <label for="turno" class="col-sm-2">Turno</label>
            <div class="col-sm-4">
              <select class="form-control" name="turno" id="turno">
              <option>Nenhum</option>
              <option value = "1">Matutino</option>
              <option value = "2">Vespertino</option>
              <option value = "3">Noturno</option>
              </select> 
            </div>
          </div>
          <div class="form-group">
            <label for="data" class="col-sm-2">Data</label>
            <div class="col-sm-4">
              <input type="date" class="form-control" name="data" id="data" required>
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
