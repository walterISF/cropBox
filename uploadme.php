<?php
$pasta = "imagens/"; /* formatos de imagem permitidos */ 
$permitidos = array(".jpg",".jpeg",".gif",".png", ".bmp"); 

if(isset($_POST)){ 
	$nome_imagem = $_FILES['imagem']['name']; 
	$tamanho_imagem = $_FILES['imagem']['size']; 
	/* pega a extensão do arquivo */ 
	$ext = strtolower(strrchr($nome_imagem,".")); 
	/* verifica se a extensão está entre as extensões permitidas */ 
	if(in_array($ext,$permitidos)){ 
	/* converte o tamanho para KB */ 
	$tamanho = round($tamanho_imagem / 1024); 
	if($tamanho < 1024){ 
	//se imagem for até 1MB envia 
	$nome_atual = md5(uniqid(time())).$ext; 
	//nome que dará a imagem 
	$tmp = $_FILES['imagem']['tmp_name'];
 	   $extensao = strtolower(end(explode('.', $nome_imagem)));
      // Define o novo nome do arquivo usando um UNIX TIMESTAMP
      $nome = 'default0'. '.' . $extensao;

	   $qtd = count($pasta);
	   for ($i=0; $i < $qtd; $i++) { 
	   		if (file_exists($nome)) {
	   			$nome = 'default'. '.' . $extensao;
	   		}
	   }
	//caminho temporário da imagem
	 /* se enviar a foto, insere o nome da foto no banco de dados */ 
	if(move_uploaded_file($tmp,$pasta.$nome)){
   		echo $nome; 
   		rename ($pasta.$nome, $pasta.$nome);
	 //imprime a foto na tela 
	}else{ 
		echo "Falha ao enviar"; 
		} 
	}else{ 
		echo "A imagem deve ser de no máximo 1MB"; 
	} 
	}else{ 
		echo "Somente são aceitos arquivos do tipo Imagem"; 
	} 
	}else{ 
		echo "Selecione uma imagem"; 
		exit; 
	} 

?>