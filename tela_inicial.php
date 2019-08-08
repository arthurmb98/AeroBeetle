<?php
//include"seguranca/seguranca.php";
?>
<html lang="pt-br">
<head>
 <meta charset="utf-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <title>AeroBeetle</title>

 <link href="css/bootstrap.min.css" rel="stylesheet">
 <link href="css/style.css" rel="stylesheet">
 <link rel="shortcut icon" href="logo1.jpeg">
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
	 <li><a href="aluno_crud/">Alunos</a></li>
	 <li><a href="curso_crud/">Cursos</a></li>
	 <li><a href="palestrante_crud/">Palestrantes</a></li>
	 <li><a href="professor_crud/">Professores</a></li>
	 <li><a href="relatorios.php">Relatórios</a></li>
	 <li><a href="#">Ajuda</a></li>
	 <li><a href="seguranca/Sair.php">Sair</a></li>
    </ul>
   </div>
  </div>
 </nav>

 <div id="main" class="container-fluid">
  <h3 class="page-header">Olá, Usuário!</h3>
 </div>
 <header id="header" data-plugin-options="{&#39;stickyEnabled&#39;: true, &#39;stickyEnableOnBoxed&#39;: true, &#39;stickyEnableOnMobile&#39;: true, &#39;stickyChangeLogoWrapper&#39;: false, &#39;stickyStartAt&#39;: 1, &#39;stickySetTop&#39;: &#39;0&#39;, &#39;stickyChangeLogo&#39;: true}">
				<div class="header-body">
					<div class="header-container container">
						<div class="header-row">
							<div class="header-column">
								<div class="header-logo">
									<a href="">
										<img alt="AeroBeetle" width="165" height="165" data-sticky-width="82" data-sticky-height="82" data-sticky-top="0" src="logo1.jpeg">
									</a>
								</div>
                            </div>
                        </div>
                    </div>
                </div>
</header>

 <footer class="short" id="footer">
				<div class="container">
					<div class="row">
						<div class="col-md-8">
							<h4>Sobre a Equipe</h4>
							<p>Nossa equipe surgiu por iniciativa própria de alguns alunos na faculdade, em participar de um projeto de competiçao com reconhecimento a nível nacional e internacional.</p>
                                                        <p>Formada for alunos dos cursos de FEngenharia Mecanica, Engenharia de Produçao, Engenharia de Controle e Automaçao e Engenharia Civil, A equipe AeroBettle através de um intercambio de conhecimento entre os cursos, reúne assim um diferencial para participar pela primeira vez, da Competiçao SAE Aerodesign na categoria Regular, que ocorrerá no Centro Técnico Aeroespacial (CTA) em Sao José dos Campos - SP, representando estado do Maranhao.</p>
							<hr class="light">
						</div>
						<div class="col-md-3 col-md-offset-1">
							<h5 class="mb-sm">Contato</h5>
							<span class="phone">(98) 98251-2016</span>
							
							<ul class="list list-icons list-icons-sm">
                                <li><i class="fa fa-envelope"></i> <a href="http://www.facebook.com/AeroBeetle">www.facebook.com/AeroBeetle</a></li>
                                <li><i class="fa fa-envelope"></i> <a href="https://www.instagram.com/equipe.aerobeetle/">www.instagram.com/equipe.aerobeetle/</a></li>
							</ul>
						
						</div>
					</div>
				</div>
				<div class="footer-copyright">
					<div class="container">
						<div class="row">
							<div class="col-md-11">
								<!--<a href="index.html" class="logo">
									<img alt="Porto Website Template" class="img-responsive" src="img/logo-footer.png">
								</a>-->
                                                                <p>AeroBeetle 2018. Todos os direitos reservados.</p>
							</div>
							
						</div>
					</div>
				</div>
			</footer>



 <script src="js/jquery.min.js"></script>
 <script src="js/bootstrap.min.js"></script>
</body>
</html>