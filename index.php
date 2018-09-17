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
        <script type="text/javascript" src="web/funcoes.js"></script>
        <script type="text/javascript">
            function validarProfessor() {
                var nome = formProfessor.nome.value;
                var email = formProfessor.email.value;
                var endereco = formProfessor.endereco.value;
                var telefone = formProfessor.telefone.value;
                if (nome == "") {
                    alert('Preencha o campo com seu nome');
                    formProfessor.nome.focus();
                    return false;
                } else if (email == "" || email.indexOf('@') == -1
                        || email.indexOf('.') == -1) {
                    alert('Preencha o campo com seu email corretamente');
                    formProfessor.nome.focus();
                    return false;
                } else if (endereco == "") {
                    alert('Preencha o campo com seu endereço');
                    formProfessor.nome.focus();
                    return false;
                } else if (telefone == "") {
                    alert('Preencha o campo com seu telefone');
                    formProfessor.nome.focus();
                    return false;
                } else {
                    document.getElementById("salvar_professor").click();
                }
            }

            function validarDisciplina() {
                var nome = formDisciplina.nome.value;
                var carga_horaria = formDisciplina.carga_horaria.value;
                if (nome == "") {
                    alert('Preencha o campo nome');
                    formDisciplina.nome.focus();
                    return false;
                } else if (carga_horaria == "") {
                    alert('Preencha o campo carga horaria');
                    formDisciplina.carga_horaria.focus();
                    return false;
                } else if (isNaN(carga_horaria)) {
                    alert('Carga Horaria deve ser numerico!');
                    formDisciplina.carga_horaria.focus();
                    return false;
                } else {
                    document.getElementById("salvar_disciplina").click();
                }
            }

            function validarTurma() {
                var nome = formTurma.nome.value;
                if (nome == "") {
                    alert('Preencha o campo nome');
                    formTurma.nome.focus();
                    return false;
                } else {
                    document.getElementById("salvar_turma").click();
                }
            }

            /* Máscaras ER */
            function mascara(o, f) {
                v_obj = o
                v_fun = f
                setTimeout("execmascara()", 1)
            }
            function execmascara() {
                v_obj.value = v_fun(v_obj.value)
            }
            function mtel(v) {
                v = v.replace(/\D/g, ""); //Remove tudo o que não é dígito
                v = v.replace(/^(\d{2})(\d)/g, "($1) $2"); //Coloca parênteses em volta dos dois primeiros dígitos
                v = v.replace(/(\d)(\d{4})$/, "$1-$2"); //Coloca hífen entre o quarto e o quinto dígitos
                return v;
            }
            function intervalo(v) {// mascara para o intervalo das notas entre 0 e 10
                v = v.replace(",", ".");// se o numero for digitado com virgula substituir por ponto
                if (v > 10) {
                    v = 10;
                } else if (v < 0) {
                    v = 0;
                }
                return v;
            }
        </script>
        <meta charset="UTF-8">
        <title></title>
        <?php echo $xajax_js; ?>
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
    <!--script para p dialog aluno-->
    <script>
        (function () {
            var updateButton = document.getElementById('updateDetails');
            var cancelButton = document.getElementById('cancel');
            var favDialog = document.getElementById('favDialog');
            // O botão Update abre uma Dialog
            updateButton.addEventListener('click', function () {
                favDialog.showModal();
            });
            // O botão cancelButtom fecha uma Dialog
            cancelButton.addEventListener('click', function () {
                favDialog.close();
            });
        })();
    </script>
</html>
<?php
//dialog xajax para exibir a lista de alunos e turmas?>