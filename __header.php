<?php
	
$title = "Brumadinho - Faça parte dessa causa";
$css = ("/css/brumadinho.css");
$menu = "home";
		

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">	
<title><?php echo ($title != "") ? "{$title} - " : NULL; ?>Brumadinho Ajuda</title>
<link rel="shortcut icon" href="/favicon.ico">
<link rel="icon" type="image/png" href="/favicon.png">
<link rel="stylesheet" href="/css/brumadinho.css">
<?php

echo ($css != "") ? "<link rel=\"stylesheet\" href=\"{$css}\">\n" : NULL; 
?>
</head>
<body>
<a name="topo" id="topo"></a>


<main>

<header>
<div class="headerLogo"><h1><a href="/" title="Brumadinho Ajuda"><i <i class="fas fa-hands-helping"></i></a></h1></div>
<div class="headerTitle"><h1><a href="/" title="Brumadinho - Faça parte dessa causa">Brumadinho Ajuda<small>Faça parte dessa causa</small></a><div>
<div class="headerSearch">
<div class="social">
				
<a href="" target="_blank" title="Facebook do Brumadinho Ajuda"><i class="fab fa-facebook-square"></i></a>
				
</div>
<form method="get" name="searchForm" id="searchForm" action="#">
<input type="search" name="search" value="" placeholder="Procurar"><button type="submit"> <i class="fas fa-search"></i> </button>
</form>
</div>
</header>


<nav>
<a <?php echo ($menu == 'home') ? "class=\"navActive\" ": NULL; ?>href="/index.php" title="Página inicial"><i class="fas fa-home"></i>Home</a>
<a <?php echo ($menu == 'notícias') ? "class=\"navActive\" ": NULL; ?>href="/noticias.php" title="Meus artigos"><i class="far fa-newspaper"></i>Notícias</a>
<a <?php echo ($menu == 'imagens') ? "class=\"navActive\" ": NULL; ?>href="/imagens.php" title="Imagens"><i class="far fa-images"></i>Imagens</a>
<a <?php echo ($menu == 'contatos') ? "class=\"navActive\" ": NULL; ?>href="/contatos.php" title="Faça contato"><i class="far fa-envelope"></i>Contatos</a>
<a <?php echo ($menu == 'sobre') ? "class=\"navActive\" ": NULL; ?>href="/sobre.php" title="Sobre o Brumadinho Ajuda"><i class="fas fa-info-circle"></i> Sobre</a>
</nav>

<content>