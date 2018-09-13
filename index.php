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
require './view/menuMatricula.php';
require './view/menuRelatorio.php';
require './view/menuLancaNota.php';

require './util/XajaxUtil.php';

session_start();

$xajaxUtilitario = new XajaxUtil();
$xajax_js = $xajaxUtilitario->getXajax_js();
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="web/css.css">
        <style>

        </style>
        <meta charset="UTF-8">
        <title></title>
        <?php echo $xajax_js; ?>
        <script type="text/javascript">
            function imprimeBoletinho() {
                var conteudo = document.getElementById('formIncluirNotas').innerHTML,
                        tela_impressao = window.open('about:blank');

                tela_impressao.document.write(conteudo);
                tela_impressao.window.print();
                tela_impressao.window.close();
            }
        </script>
        <script type="text/javascript">
            function mascara(t, mask) {
                var i = t.value.length;
                var saida = mask.substring(1, 0);
                var texto = mask.substring(i)
                if (texto.substring(0, 1) != saida) {
                    t.value += texto.substring(0, 1);
                }
            }
        </script>
        <script type="text/javascript">
            //funcao responvalvel por perguntar o usuario se realmente quer continuar ele recebe o nome
            // de um formulario hidden para ser clicado caso for true a resposta do ussuario
            function confirmacao(acao) {
                var retVal = confirm("Deseja continuar ?");
                if (retVal == true) {
                    document.getElementById(acao).click();// pede a confirmacao do usuario se for true passa o campo do input hidden para terminar a rotina
                    return true;
                } else {
                    return false;
                }
            }

        </script>
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
<?php
//dialog xajax para exibir a lista de alunos e turmas?>