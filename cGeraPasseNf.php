<? session_start(); ?>
<?
 //require("seguranca.php");



 //Assinatura
 require_once("xmlSign/cAssinaXml.php");

 //Verifica Conexao
 require_once("xmlSign/cVerConexao.php");

 //Enviar o XML
 require_once("xmlSign/cEnviaNF.php");

?>

<?php

 class cGeraPasseNf {

	/*
	 *   xmlArq � o xml que vai ser assinado de acordo com a Nota Fiscal Eletronica
       strChave � achave acesso de acordo com NFEstrChave
       login   o nome do arquivo � composto com  o nome login tipo  RODRIGO_NUMERO.XML
       in_nf   numero da Nota fiscal
       arqSalvar endere�o onde vai salvar o arquivo XML assinado
       chavePrivat o endere�o da chave privada no formato pem
       chavePublic o endere�o da chave public no formato pem
       filial  filial da empresa

	 */

	function gerarPasse(){


		  $arqSalvar = "xml/xml_assinado/";

		   $arqXmlAssinado = $cAssinar->fAssinXML( $xmlArq ,"NFe".$strChave , $login ,(int)$in_nf,$arqSalvar,$chavePrivate,$chavePublic,$filial);

  }

 }

?>
