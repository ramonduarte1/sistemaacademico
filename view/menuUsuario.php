<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function menuUsuario($tipo, $form) {
    $obj_response = new xajaxResponse();

    if ($tipo == 'pesquisa') {
        $html = <<<HTML
        <h2 class="centralizado">Cadastro Usuario</h2><br><br>
        <form id="formPesquisa" name="formPesquisa" method="post">     
        <table border="0">
            <tr>
                <th>Pesquisa</th>
                <td>
                    <input required="" type="text" size="50" id="pesq_usuario" name="pesq_usuario">
                </td>
                <td>
                    <input type="button" class="button" value="Pesquisar" onclick="xajax_menuUsuario('filtrar', xajax.getFormValues('formPesquisa'))">
                </td>
            </tr>
            <table border='0'>
                <tr>
                    <td class="esquerda">
                        <input type="radio" id="radio" value="1" name="radio" checked>Nome
                    </td>
                    <td class="esquerda">
                        <input type="radio" id="radio" value="2" name="radio" > Codigo
                    </td>
                </tr>
            </table>
        </table>
            <hr />
            <div class='centralizado'>
                <input  type="button" class="button" value="Novo" onclick="xajax_menuUsuario('novo')">
                <input  type="button" class="button" value="Limpar" onclick="xajax_menuUsuario('pesquisa')">
            </div>
        </form>
        <hr />
        <br>
        <div id="retorno" name="retorno"></div>
HTML;
        $obj_response->assign("conteudoPagina", "innerHTML", $html);
    }

    if ($tipo == 'filtrar') {
        $usuario = new Usuario();
        $usuarios = $usuario->retornaUsuarios($form['radio'], $form['pesq_usuario']);

        $html = '<div id="" style="overflow:scroll; height:350px;">'; //scroll
        foreach ($usuarios as $u) {
            $html .= '<form class="centralizado" id="' . formIdUsuario . $u['id'] . '" name="' . formIdUsuario . $u['id'] . '" action="" method="post">
                            <input readonly id="matricula" name="matricula" value="' . $u['id'] . '" size="4">
                            <input readonly id="nome" name="nome" value="' . $u['login'] . '">
                            <input type="button" class="button" value="Apagar"  onclick="confirmacao(\'' . apagar_usuario . $u['id'] . '\');">
                            <input type="hidden" id="' . 'apagar_usuario' . $u['id'] . '" name="' . 'apagar_usuario' . $u['id'] . '"  onclick="xajax_apagarUsuario(xajax.getFormValues(' . formIdUsuario . $u['id'] . '))">
                       </form>';
        }
        $html .= '</div>';

        $obj_response->assign("retorno", "innerHTML", $html);
    }

    if ($tipo == 'novo') {
        $html = <<<HTML
            <form id="formUsuario" name="formUsuario" method="post">
                <table>
                    <tr>
                        <td class="direita">Usuario</td>
                        <td>
                            <input type="text" id="nome" name="nome" size="50">
                        </td>
                    </tr>
                    <tr>
                        <td class="direita">Senha</td>
                        <td><input type="password" id="password" name="password" size="50"></td>
                    </tr>
                    <tr>
                        <td class="direita">Confirma a senha</td>
                        <td><input type="password" id="password2" name="password2" size="50"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="button" class="button" value="Salvar" onclick="return validarUsuario()"></td>
                        <input type="hidden" id="salvar_usuario" name="salvar_usuario" onclick="xajax_salvarUsuario(xajax.getFormValues('formUsuario'))">
                    </tr>
                </table>
           </form>
HTML;
        $obj_response->assign("retorno", "innerHTML", $html);
    }

    return $obj_response;
}
