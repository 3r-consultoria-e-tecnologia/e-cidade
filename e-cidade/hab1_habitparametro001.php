<?
/*
 *     E-cidade Software Publico para Gestao Municipal                
 *  Copyright (C) 2009  DBselller Servicos de Informatica             
 *                            www.dbseller.com.br                     
 *                         e-cidade@dbseller.com.br                   
 *                                                                    
 *  Este programa e software livre; voce pode redistribui-lo e/ou     
 *  modifica-lo sob os termos da Licenca Publica Geral GNU, conforme  
 *  publicada pela Free Software Foundation; tanto a versao 2 da      
 *  Licenca como (a seu criterio) qualquer versao mais nova.          
 *                                                                    
 *  Este programa e distribuido na expectativa de ser util, mas SEM   
 *  QUALQUER GARANTIA; sem mesmo a garantia implicita de              
 *  COMERCIALIZACAO ou de ADEQUACAO A QUALQUER PROPOSITO EM           
 *  PARTICULAR. Consulte a Licenca Publica Geral GNU para obter mais  
 *  detalhes.                                                         
 *                                                                    
 *  Voce deve ter recebido uma copia da Licenca Publica Geral GNU     
 *  junto com este programa; se nao, escreva para a Free Software     
 *  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA          
 *  02111-1307, USA.                                                  
 *  
 *  Copia da licenca no diretorio licenca/licenca_en.txt 
 *                                licenca/licenca_pt.txt 
 */

require("libs/db_stdlib.php");
require("libs/db_conecta.php");
include("libs/db_sessoes.php");
include("libs/db_usuariosonline.php");
include("classes/db_habitparametro_classe.php");
include("dbforms/db_funcoes.php");
parse_str($HTTP_SERVER_VARS["QUERY_STRING"]);
db_postmemory($HTTP_POST_VARS);
$clhabitparametro = new cl_habitparametro;
$db_opcao = 2;

if( isset($incluir) || isset($alterar)){
  db_inicio_transacao();
  if ( isset($incluir) ) {
    $clhabitparametro->incluir(null);
  } else {
    $clhabitparametro->alterar($ht16_anousu);
  }
  db_fim_transacao();

} else {
	
	$result = $clhabitparametro->sql_record($clhabitparametro->sql_query(db_getsession('DB_anousu')));
	
	if ($clhabitparametro->numrows > 0 ) {
		db_fieldsmemory($result,0);
	} else {
	  $db_opcao = 1;	
	}
	
}

   
?>
<html>
<head>
<title>DBSeller Inform&aacute;tica Ltda - P&aacute;gina Inicial</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<meta http-equiv="Expires" CONTENT="0">
<script language="JavaScript" type="text/javascript" src="scripts/scripts.js"></script>
<link href="estilos.css" rel="stylesheet" type="text/css">
</head>
<body bgcolor=#CCCCCC leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" onLoad="a=1" >
<table align="center" style="padding-top:25px;">
  <tr> 
    <td> 
			<?
			  include("forms/db_frmhabitparametro.php");
			?>
  	</td>
  </tr>
</table>
<?
db_menu(db_getsession("DB_id_usuario"),db_getsession("DB_modulo"),db_getsession("DB_anousu"),db_getsession("DB_instit"));
?>
</body>
</html>
<?
if( isset($incluir) || isset($alterar) ){
  if($clhabitparametro->erro_status=="0"){
    $clhabitparametro->erro(true,false);
    echo "<script> document.form1.db_opcao.disabled=false;</script>  ";
    if($clhabitparametro->erro_campo!=""){
      echo "<script> document.form1.".$clhabitparametro->erro_campo.".style.backgroundColor='#99A9AE';</script>";
      echo "<script> document.form1.".$clhabitparametro->erro_campo.".focus();</script>";
    }
  }else{
    $clhabitparametro->erro(true,true);
  }
}
?>