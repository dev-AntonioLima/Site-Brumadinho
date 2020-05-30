<?php

require("/__config.php");

$title = "";

$css = "/css/brumadinho.css";

$menu = "contatos";

function sanitize($v) {
$v = trim($v);
$v = stripslashes($v);
$v = htmlspecialchars($v); 

while(strpos($v, "  ")) 
$v = str_replace("  ", " ", $v);

return $v;
}


$nome = $email = $assunto = $mensagem = "";


$erro = "";


$sucesso = false;


$alertaNome = $alertaEmail = $alertaAssunto = $alertaMensagem = $alertaRecaptcha = false;


$alerta = " class=\"alerta\" onfocus=\"this.style.background='#fff'\"";


$enviado = (isset($_POST['enviado'])) ? sanitize($_POST['enviado']) : false;


if ($enviado):

	
$nome = sanitize($_POST['nome']);
$email = sanitize($_POST['email']);
$assunto = sanitize($_POST['assunto']);
$mensagem = sanitize($_POST['mensagem']);


if (strlen($nome) < 3):
$erro .= "<li>O nome deve ter pelo menos 3 caracteres.</li>";
$alertaNome = true;
else:
		
if (!preg_match("/^[a-zA-ZÀ-ÿ ]*$/", $nome)):
$erro .= "<li>Seu nome deve conter apenas letras e espaços.</li>";
$alertaNome = true;
endif;
endif;


if ( !filter_var($email, FILTER_VALIDATE_EMAIL) ):
$erro .= "<li>Seu e-mail está inválido;</li>";
$alertaEmail = true;
endif;

	
$contaAssunto = strlen($assunto);
if ($contaAssunto == 0):
$erro .= "<li>Escreva um assunto para o contato.</li>";
$alertaAssunto = true;
elseif ($contaAssunto < 3):
$erro .= "<li>O assunto está muito curto.</li>";
$alertaAssunto = true;
endif;


$contaMensagem = strlen($mensagem);
if ($contaMensagem == 0):
$erro .= "<li>Escreva uma mensagem para o contato.</li>";
$alertaMensagem = true;
elseif ($contaMensagem < 5):
$erro .= "<li>A mensagem está muito curta.</li>";
$alertaMensagem = true;
endif;


if ($erro == ""):

$sql = "INSERT INTO contatos (nome, email, assunto, mensagem) VALUES ('{$nome}', '{$email}', '{$assunto}', '{$mensagem}')";

if ( !$conn->query($sql) ):

$erro = "<li>Ocorreu um erro no banco de dados.</li>";

else:

		
$mailAdminsitrador = "admin@ajudabrumadinho.tk";

$mailAssunto = "Formulário de Contatos de 'Ajuda Brumadinho'";

		
$mailMensagem = "
<!DOCTYPE html>
<html lang=\"pt-br\">
<head><title>Formulário de Contatos de 'Brumadinho Ajuda'</title></head>
<body>
<p><i>Olá!</i></p>
<p>O formulário de contatos de 'Brumadinho Ajuda' foi enviado:</p>
<ul>
<li><b>Nome:</b> {$nome}</li>
<li><b>E-mail:</b> {$email}</li>
<li><b>Assunto:</b> {$assunto}</li>
</ul>
<hr><pre>{$mensagem}</pre><hr>
</body></html>
			";
			
$mailHeader = "MIME-Version: 1.0" . "\r\n";
$mailHeader .= "Content-type:text/html;charset=UTF-8" . "\r\n";

	
$mailHeader .= 'From: <root@localhost>' . "\r\n";
	
			
@mail($mailAdminsitrador, $mailAssunto, $mailMensagem, $mailHeader);

			
$nomesArray = explode(" ", $nome); 
$primeiroNome = ucfirst($nomesArray[0]); 

		
$nome = $email = $assunto = $mensagem = null;
unset($_POST);

		
$sucesso = true;

endif;

endif;

endif;
 

$title = "Faça Contato";


$css = "/css/contatos.css";


$menu = "contatos";


require('/__header.php'); 
?>

<div class="contatoContainer">

<div class="contatoForm">

<h2>Faça Contato</h2>
<small class="autor">
<a href="/sobre.php">Sobre o Brumadinho Ajuda</a> &nbsp;&bull;&nbsp; <a href="/privacidade.php">Políticas de Privacidade</a>
</small>
<p>Use o formulário abaixo para nos comunicar sobre sua doação.</p>
	
<form method="post" name="contatos" id="contatos" action="<?php echo $_SERVER['PHP_SELF'] ?>">
	<input type="hidden" name="enviado" value="ok">

	<small class="redAlert">* Todos os campos são obrigatórios!</small>

	
<?php


if ($erro != ""):

echo <<<ERRO
		
<div class="msgErro" onclick="this.style.display='none'">
<span>&times;</span>
<h3>Ooops!</h3>
<p>Ocorreram erros que impedem o envio do seu contato:</p>
<ul>
{$erro}
</ul>
Por favor, corrija os erros e tente novamente...
</div>
&nbsp;
ERRO;

endif;



if ($sucesso):

echo <<<SUCESSO
		
<div class="msgSucesso" onclick="this.style.display='none'">
<span>&times;</span>
<h3>Olá {$primeiroNome}!</h3>
<p>Contato enviado com sucesso, obrigado pela sua ajuda!</p>
<p><em>Obrigado...</em></p>
</div>
&nbsp;

SUCESSO;

endif;
?>
	

<p>
<label for="nome">Nome Completo:</label>
<input type="text" name="nome" id="nome" value="<?php echo $nome ?>"<?php echo ($alertaNome) ? $alerta : ""; ?>>
</p>
<p>
<label for="email">Seu e-mail:</label>
<input type="text" name="email" id="email" value="<?php echo $email ?>"<?php echo ($alertaEmail) ? $alerta : ""; ?>>
</p>
<p>
<label for="assunto">Assunto:</label>
<input type="text" name="assunto" id="assunto" value="<?php echo $assunto ?>"<?php echo ($alertaAssunto) ? $alerta : ""; ?>>
</p>
<p>
<label for="mensagem">Mensagem:</label>
<textarea name="mensagem" id="mensagem"<?php echo ($alertaMensagem) ? $alerta : ""; ?>><?php echo $mensagem ?></textarea>
</p>
<p>
<label for="enviar"></label>
<button type="submit" name="enviar" id="enviar" value="enviado">Enviar</button>
<small>&larr; Clique no botão somente uma vez.</small>
</p>
</form>

<script>document.getElementById("contatos").focus();</script>

</div>
	
</ul>
</div>

</div>

</div>

<?php 

require('/_footer.php');
?>