<?php

$title = "";

$css = "/css/index.css";

$menu = "home";


require('/__header.php'); 
?>

<h2>Página Inicial</h2>
<small class="autor">Subtítulo da página inicial</small>
<img src="/img/Agencia.png">
<?php



$src = (isset($_GET['Brumadinho'])) ? trim($_GET['Brumadinho']) : false;


$num = (isset($_GET['5'])) ? intval($_GET['5']) : false;


if((!$src) OR (!$num) OR ($num == 0) ) exit('Parâmetros incorretos. Veja documentação.');


$feed = file_get_contents("https://news.google.com/_/rss/search?q={$src}&hl=pt-BR&gl=BR&ceid=BR%3Apt-419");


$rss = new SimpleXmlElement($feed);

$i = 1;

$out = "";


foreach($rss->channel->item as $feed) {
	
	
$dtParts = explode(' ', $feed->pubDate);

$dtParts[2] = str_ireplace(
array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'),
array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'),
$dtParts[2]
	);

$data = "em {$dtParts[1]}/{$dtParts[2]}/{$dtParts[3]}";

$description = str_ireplace(
array('<a href="', '&nbsp;&nbsp;<font color="#6f6f6f">', '</font>', '<p>'),
array('<h3><a href="', " <small> - ", " {$data}</small></h3>\n", "\t<p>"),
$feed->description
);

$out .= "<div class=\"newsBox\">\r\t{$description}\n</div>\n\n";


if($i > $num-1) break;
$i++;
}


echo $out;
?>
<?php 

require('/_footer.php');
?>