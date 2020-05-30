<?php

require("/__config.php");

$id = (isset($_GET['id'])) ? intval($_GET['id']) : false;

if(!$id) 
header('location: artigos.php');
 
$sql = "SELECT *, DATE_FORMAT(data,'%d/%m/%Y às %H:%i') AS dataBr FROM artigos WHERE id = '{$id}' AND data <= NOW() AND status != 'apagado'";

$dados = $conn->query($sql);

if ($dados->num_rows == 0) 
header('location: artigos.php');

$campo = $dados->fetch_assoc();

$autor = "Publicado em {$campo['dataBr']} por <a href='{$campo['autor_site']}' target='_blank'>{$campo['autor_nome']}.</a>";

$exibe = <<<HTML

{$campo['html']}

HTML;

$cat = explode(', ', $campo['categorias']);
$categorias = "";
foreach ($cat AS $valor):
$categorias .= "<a href='artigos.php?cat={$valor}'>{$valor}</a>, ";
endforeach;

$categorias = substr($categorias, 0, -2) . ".";

$title = $campo['titulo'];

$css = "/css/artigos.css";

$menu = "artigos";

require('/__header.php'); 
?>

<h2><?php echo $title ?></h2>
<small class="autor"><?php echo $autor ?></small>
<?php echo $exibe; ?>
<div class="categorias">
<b>Categorias:</b> <?php echo $categorias ?>
</div>

<?php 
require('/_footer.php');
?>