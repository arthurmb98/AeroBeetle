<?php
include"../seguranca/seguranca.php";

require_once '../dao/DAOAluno.php';

$aluno = DAOAluno::getInstance()->select($_GET['idButton']);


?>

<html lang="pt-br">
<head>
  <title>Editar Aluno</title>
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
<form role="form" class="form-horizontal" action="../forms/CadAluno.php?idAluno=<?php echo $aluno->getIdAluno();?>" method="post"> 
    <div class="modal-header"></div>
        <div class="form-group">
            <label for="nome" class="col-sm-2">Nome</label>
            <div class="col-sm-4">
              <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome completo" value="<?php echo $aluno->getNome();?>" required>
            </div>
            <label for="matricula" class="col-sm-2">Matricula</label>
            <div class="col-sm-4">
                <input type="number" class="form-control" name="matricula" id="matricula" placeholder="Número de Matricula" value="<?php echo $aluno->getMatricula();?>" required>
            </div>
        </div>
        <div class="form-group">
            <label for="email" class="col-sm-2">Email</label>
            <div class="col-sm-4">
              <input type="email" class="form-control" name="email" id="email" placeholder="Endereço de Email" value="<?php echo $aluno->getEmail();?>" required>
            </div>
            <label for="telefone" class="col-sm-2">Telefone</label>
            <div class="col-sm-4">
              <input type="number" class="form-control" name="telefone" id="telefone" placeholder="Número de Telefone ou Celular" value="<?php echo $aluno->getTelefone();?>" required>
            </div>
        </div>
        <div class="form-group">
            <label for="periodo" class="col-sm-2">Periodo</label>
            <div class="col-sm-4">
              <input type="number" max="12" class="form-control" name="periodo" id="periodo" placeholder="Periodo (ex: 7)" value="<?php echo $aluno->getPeriodo();?>" required>
            </div>
             <label for="selecaoEJ" class="col-sm-2">Graduação</label>
            <div class="col-sm-4">
              <select class="form-control" name="graduacao" id="graduacao">
              <option value = "<?php echo $aluno->getGraduacao();?>">Padrao</option>
              <option value = "1">Engenharia</option>
              </select> 
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
