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
	 *   xmlArq é o xml que vai ser assinado de acordo com a Nota Fiscal Eletronica
       strChave é achave acesso de acordo com NFEstrChave
       login   o nome do arquivo é composto com  o nome login tipo  RODRIGO_NUMERO.XML
       in_nf   numero da Nota fiscal
       arqSalvar endereço onde vai salvar o arquivo XML assinado
       chavePrivat o endereço da chave privada no formato pem
       chavePublic o endereço da chave public no formato pem
       filial  filial da empresa

	 */

	function gerarPasse(){


		  $arqSalvar = "xml/xml_assinado/";

		   $arqXmlAssinado = $cAssinar->fAssinXML( $xmlArq ,"NFe".$strChave , $login ,(int)$in_nf,$arqSalvar,$chavePrivate,$chavePublic,$filial);

  }

 }

?>
