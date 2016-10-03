<?php

/**
 * 
 * Database Constants
 * Obviamente tudo deve ser mudado depois de acordo com 
 * as minhas configurações
 * problemas com o password? 
 * pilitica média de segurança?
 * UNINSTALL PLUGIN validate_password;
 * enter mysqly: mysql -u jonas -p photo_gallery
 * Obs: use photo_gallery vai direto para esse banco
 * de dados especifico, se quiser usar outro, basta 
 * deixar em branco e depois use photo_gallery por exemplo
 * 
 * ou apresentando o passowrd direto no camando:
 * 
 * mysql -u jonas --password="123456" photo_gallery
 */
define("DB_SERVER","localhost");		
define("DB_USER","jonas");		
define("DB_PASS","123456");		
define("DB_NAME","photo_gallery"); 

?>
