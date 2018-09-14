<?php

function exibeLogin() {
    $obj_response = new xajaxResponse();
    $html = <<<HTML
           <div class="container">
            <div class="box"><br>
                <form id="formLogin" name="formLogin" method="post">
                    <table class="logincentro">
                        <tr>
                            <td>Usuario</td>
                        </tr>
                        <tr>
                            <td><input name="login" id="login" type="text" size="20"></td>
                        </tr>
                        <tr>
                            <td>Senha</td>
                        </tr>
                        <tr>
                            <td><input name="senha" id="senha" type="password" size="20"></td>
                        </tr>
                        <tr>
                            <td><input type="button" onclick="xajax_verificaCredenciais(xajax.getFormValues('formLogin'))" value="Entrar"/></td>
                        </tr>
                        <tr>
                            <td><a href="#" class="centralizado"> Esqueceu a senha?</a></td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
HTML;

    $obj_response->assign("conteudo", "innerHTML", $html);
    return $obj_response;
}