<?php
/*********************************************************************
 *  Classe Responsavel pela Assinatura do XML
 *
 *********************************************************************/

 require('../libs/xmlseclibs.php');

 class cAssinaXML {

	/******************************************************************
	 *
	 ******************************************************************/

	 function fAssinXML( $arq , $id , $usuario , $nf,$arqSalvar,$privada,$publica,$filial){



	   /*$privatekey = 'xmlSign/KeyPrivadacrpaaa.pem';
       $publiccert = 'xmlSign/KeyPublicacrpaaa.pem';
       */

	   $privatekey = $privada;
       $publiccert = $publica;

       $doc = new DOMDocument();

	   $handle = @fopen($arq, "r+");

       if ($handle) {

        while (!feof($handle))
		 $buffer = $buffer  .  ltrim(rtrim(fgets($handle),"\t\n\r\0\x0B"),"\t\n\r\0\x0B");

	    fclose($handle);
	   }




       $buffer = utf8_encode($buffer);

      $doc->preservWhiteSpace = FALSE; //elimina espaços em branco
      $doc->formatOutput = FALSE;
      $doc->loadXML( $buffer,LIBXML_NOBLANKS | LIBXML_NOEMPTYTAG );

	  $objDSig = new XMLSecurityDSig();

      $objDSig->setCanonicalMethod(XMLSecurityDSig::C14N);

      $element=$doc->getElementsByTagName('infNFe')->item(0);

      //Assinatura
      $elementAssinatura=$doc->getElementsByTagName('NFe')->item(0);

      $options=array('prefix'=>NULL,
                     'prefix_ns' => NULL,
			         'id_name'   =>  'Id',
			         'overwrite' => FALSE,
			         'attValue'  => $id);


      $transforms = array('http://www.w3.org/2000/09/xmldsig#enveloped-signature','http://www.w3.org/TR/2001/REC-xml-c14n-20010315');


      $objDSig->addReference($element, XMLSecurityDSig::SHA1, $transforms,$options);


      $objKey = new XMLSecurityKey(XMLSecurityKey::RSA_SHA1, array('type'=>'private'));
      $objKey->loadKey($privatekey, TRUE);

      $objDSig->sign($objKey);

      $objDSig->add509Cert(file_get_contents($publiccert));

      $objDSig->appendSignature($elementAssinatura);

      $doc->formatOutput = FALSE;


	  $doc->save($arqSalvar);
      return $arqSalvar;
   }

 }

?>
