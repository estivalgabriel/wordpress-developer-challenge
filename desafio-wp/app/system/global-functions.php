<?php
/*
Responsavel por proteger as strings

@param string $string	A string tratada
@param bollean $html	Se tiver que ser desconsiderado as tags html

@return string			String Protegida
*/
//*****************************************************************************
function proteger($string, $html=false){

	//verifico se não é uma array
	if(!is_array($string)){
		$string = preg_replace("/(from|select|insert|delete|where|drop table|show tables|\*|--|\\\\)/","",$string);
		$string = str_replace("<script","",$string);
		$string = str_replace("script>","",$string);
		$string = str_replace("<Script","",$string);
		$string = str_replace("Script>","",$string);

		$string = trim($string);						//limpa espaços vazio
		if($html==false){
			$string = strip_tags($string);				//tira tags html e php
		}
		$string = addslashes($string);					//Adiciona barras invertidas a uma string
	}

	return $string;
}
//*****************************************************************************


/*
responsavel por criar slugs

@param string $str 		recebe a string p/ tirar a acentuacao e espacos
*/
//*****************************************************************************
function slug($str){

		$str = trim($str);
		$str = preg_replace('/[áàãâä]/ui', 'a', $str);
    $str = preg_replace('/[éèêë]/ui', 'e', $str);
    $str = preg_replace('/[íìîï]/ui', 'i', $str);
    $str = preg_replace('/[óòõôö]/ui', 'o', $str);
    $str = preg_replace('/[úùûü]/ui', 'u', $str);
    $str = preg_replace('/[ç]/ui', 'c', $str);
    // $str = preg_replace('/[,(),;:|!"#$%&/=?~^><ªº-]/', '_', $str);
    $str = preg_replace('/[^a-z0-9]/i', '-', $str);
		$str = str_replace('  ', ' ', $str);
		$str = str_replace('--', '-', $str);
    $str = preg_replace('/_+/', '-', $str); // ideia do Bacco :)

		$str = strtolower($str);

	return $str;
}
//*****************************************************************************


/*
deleta a pasta e seus arquivos

@param string $dir 		O diretorio a ser apagado
*/
//*****************************************************************************
function del_pasta($dir){

	if($x = opendir($dir)){
		while(false !== ($file = readdir($x))){
			if($file != "." && $file != ".."){

				$path = $dir."/".$file;

				if(is_dir($path)){
					del_pasta($path);
				}
				else if(is_file($path)){
					unlink($path);
				}
			}
		}
		closedir($x);
	}
	rmdir($dir);
}
//*****************************************************************************


/*
responsavel por enviar e-mails na aplicacao

@param array 	$destinarario	São as pessoas que receberao esse email
@param array 	$copia			São as pessoas que receberao uma copia desse e-mail
@param string 	$assunto		É o assunto do e-mail
@param string	$body			É o corpo em html
@param bollean	$isSMTP			Defini se o e-mail será enviado de forma autenticada ou não.
*/
//*****************************************************************************
function smtp_enviar_email($mensagem, $destino, $assunto, $enviadopor, $emailresposta, $nomeresposta){

	require_once(get_template_directory().'/app/classes/Phpmailer.class.php');

	$mail             	= 	new PHPMailer();

	//defino os parametros que vou utilizar
	$body					= $mensagem;
	$emailsender	= get_option('pro_configevviva_email_smtp');
	$nomesender		= $enviadopor;
	$destino			= $destino;
	$assunto			= $assunto;

	$mail->IsSMTP(); 																		                        // telling the class to use SMTP
	$mail->Host       	= get_option('pro_configevviva_email_host');														// SMTP server
	$mail->SMTPDebug  	= 1;                     											          // enables SMTP debug information (for testing)
	$mail->SMTPAuth   	= true;
	$mail->Port       	= 587;                    									            // set the SMTP port for the GMAIL server
	$mail->Username   	= get_option('pro_configevviva_email_smtp'); 													// SMTP account username
	$mail->Password   	= get_option('pro_configevviva_email_senha');        		    																	// SMTP account password
	$mail->CharSet 		  = 'UTF-8';

	//mensagem
	$corpo = create_html_email($mensagem);

	$mail->From 	  	= get_option('pro_configevviva_email_smtp');
	$mail->FromName   = $nomesender;

	$mail->Subject    = $assunto;
	$mail->AltBody    = "Caso não visualize essa mensagem entre em contato conosco."; // optional, comment out and test

	$mail->MsgHTML($corpo);
	$mail->AddReplyTo($emailresposta, $nomeresposta);
	$mail->AddAddress($destino[0]['email'], $destino[0]['nome']);

	//crio um contador p/ enviar os e-mails em cópia
	if(count($destino) > 1){
		unset($destino[0]);

		foreach($destino as $valor){
			$mail->AddBCC($valor['email'], $valor['nome']);
		}
	}

	if($mail->Send()){

      echo alert_toast(1);
    }else{
			echo 'nao enviou';
		echo alert_toast(0);
    }

	return true;
}


function create_html_email($mensagem){

	$html = '';
	$html .= '<html>';
	$html .= '<head>';
	$html .= '<title>Monera</title>';
	$html .= '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">';
	$html .= '</head>';
	$html .= '<body bgcolor="#f0ecec" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">';
	$html .= '<div style="background-color:#f0ecec;">';
	$html .= '<table>';
	$html .= '<tr>';
	$html .= '<td height="30">';
	$html .= '</td>';
	$html .= '</tr>';
	$html .= '</table>';
	$html .= '<table align="center" width="650" border="0" cellpadding="30" cellspacing="0" bgcolor="#ffffff">';
	$html .= '<tr>';
	$html .= '<td colspan="8" bgcolor="#ffffff">';
	$html .= $mensagem;
	$html .= "<br><br>";
	$html .= 'Obrigado.<br> Monera';
	$html .= "<br><br>";
	$html .= '</tr>';
	$html .= '</table>';
	$html .= '<table>';
  $html .= '<tr>';
  $html .= '<td height="30">';
  $html .= '</td>';
  $html .= '</tr>';
	$html .= '</table>';
	$html .= '</div>';
	$html .= '</body>';
	$html .= '</html>';

	return $html;
}

function cria_lista_emails($emails){
	$temp = explode(';', $emails);

	$dest = array();
	$i = 0;

	foreach($temp as $valor){
		if($valor != ''){
			$dest[$i]['nome'] = $valor;
			$dest[$i]['email'] = $valor;

			$i++;
		}
	}

	return $dest;
}

function alert_toast($bollean){

	switch ($bollean) {
		case 1:
			$dep =
			"
			<script src='".get_template_directory_uri()."/public/assets/js/jquery.min.js'></script>
			<script src='".get_template_directory_uri()."/public/assets/js/jquery.toast.min.js'></script>

			<script>
			$.toast({
			  heading: 'SUCESSO',
			  text: 'Seu e-mail foi enviado com sucesso!',
			  hideAfter: false,
			  icon: 'success'
			})
		  	</script>";
			break;
		case 0:
			$dep =
			"
			<script src='".get_template_directory_uri()."/public/assets/js/jquery.min.js'></script>
			<script src='".get_template_directory_uri()."/public/assets/js/jquery.toast.min.js'></script>

			<script>
			$.toast({
			  heading: 'Erro Interno',
			  text: 'OPS, ALGO DEU ERRADO, SEU EMAIL NÃO FOI ENVIADO POR ALGUM PROBLEMA INTERNO! TENTE NOVAMENTE MAIS TARDE.',
			  hideAfter: false,
			  icon: 'error'
			})
	  		</script>";
			break;
	}
	return $dep;
}

// remove espaço e caracteres especiais
function sanitizeString($str) {
  $str = preg_replace('/[áàãâä]/ui', 'a', $str);
  $str = preg_replace('/[éèêë]/ui', 'e', $str);
  $str = preg_replace('/[íìîï]/ui', 'i', $str);
  $str = preg_replace('/[óòõôö]/ui', 'o', $str);
  $str = preg_replace('/[úùûü]/ui', 'u', $str);
  $str = preg_replace('/[ç]/ui', 'c', $str);
  $str = preg_replace('/[^a-z0-9]/i', '', $str);
  $str = preg_replace('/_+/', '_', $str);
  return $str;
}

//verifica se o site está sendo acessado via mobile
function is_mobile(){

	$is_mobile = FALSE;
	$user_agents = array("iPhone","iPad","Android","webOS","BlackBerry","iPod","Symbian","IsGeneric");

	foreach($user_agents as $user_agent){
			if (strpos($_SERVER['HTTP_USER_AGENT'], $user_agent) !== FALSE) {
					$is_mobile = TRUE;
					$modelo = $user_agent;
					break;
			}
	}

	return $is_mobile;
}

// função responsável para gerenciar os javascripts

  function check_page($page){
		$url_atual= "$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";


	  if($url_atual == $_SERVER['HTTP_HOST']){
	    return 'home';
	  }

	  $pos = strpos( $url_atual, $page );

	  if ($pos === false) {
	   return '0';
	  } else {
	   return '1';
	  }

  }
?>
