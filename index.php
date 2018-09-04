<?php
ini_set('display_errors', true);
require './util/autoload.php';
require './lib/xajax_core/xajax.inc.php';
require './view/login.php';
require './view/menu.php';
require './view/menuAluno.php';
require './view/menuProfessor.php';
require './view/menuDisciplina.php';
require './view/menuTurma.php';

require './util/XajaxUtil.php';

session_start();
//var_dump($_SESSION);
$xajaxUtilitario = new XajaxUtil();
$xajax_js = $xajaxUtilitario->getXajax_js();
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="web/css.css">
        <meta charset="UTF-8">
        <title></title>
        <?php
        echo $xajax_js;
        ?>
    </head>
    <body onload="xajax_menuPrincipal();">
        <div id="pagina">
            <div id="conteudo">
                <noscript>
                <?php
                echo
                '<fieldset>
                    <h3>Seu navegador está com o JavaScript desativado, por favor ative para o melhor funcionamento do sistema.</h3>
                    Depois de ativar o JavaScript clique <a href=\'index.php\'>aqui</a>.
                </fieldset>';
                ?>
                </noscript>
            </div>
            <br>
            <div id="conteudoPagina"></div>
        </div>
    </body>
</html>
