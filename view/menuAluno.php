<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function menuAluno($tipo) {
    $obj_response = new xajaxResponse();
    $a=1;

    if ($tipo == 'pesquisa') {
        $html = <<<HTML
        <h2 class="centralizado">Cadastro Aluno</h2><br><br>
        <table border="0">
            <tr>
                <th>Pesquisa</th>
                <td>
                    <table id="formPesquisa" name="formPesquisa">
                        <input required="" type="text" size="50" id="pesq_aluno" name="pesq_aluno">
                    </table>
                </td>
                <td>
                    <button onclick="xajax_pesquisaAluno(xajax.getFormValues('formPesquisa'))">Pesquisar</button>
                </td>
            </tr>
            <tr>
                <td></td>
                <td class="esquerda">
                    <input type="radio" id="radio" value="1" name="radio"> Pesquisar apenas alunos matriculados
                </td>
            </tr>
            <tr>
                <td></td>
                <td class="esquerda">
                    <input type="radio" id="radio" value="2" name="radio" checked> Pesquisar apenas alunos não matriculado
                </td>
            </tr>
            <tr>
                <td><input type="button" value="Novo" onclick="xajax_menuAluno('novo')"></td>
                <td><input type="button" value="Limpar" onclick="xajax_menuAluno('pesquisa')"></td>
            </tr>
        </table>
        <hr />
        <br>
        <div id="retorno" name="retorno"></div>
HTML;
        $obj_response->assign("conteudoPagina", "innerHTML", $html);
    }

    if ($tipo == 'novo') {
        $html = <<<HTML
            <form id="formAluno" name="formAluno" method="post">
                <table>
                    <tr>
                        <td class="direita">Nome</td>
                        <td>
                            <input type="text" required name="nome" size="50">
                        </td>
                    </tr>
                    <tr>
                        <td class="direita">Email</td>
                        <td><input type="email" required name="email" size="50"></td>
                    </tr>
                    <tr>
                        <td class="direita">Endereço</td>
                        <td><input type="text" required name="endereco" size="50"></td>
                    </tr>
                    <tr>
                        <td class="direita">Telefone</td>
                        <td><input type="text" required name="telefone" onkeypress="mascara(this, '## #####-####')" maxlength="13"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="button" value="Salvar" onclick="xajax_salvarAluno(xajax.getFormValues('formAluno'))"></td>
                    </tr>
                </table>
           </form>
HTML;
        $obj_response->assign("retorno", "innerHTML", $html);
    }

    if ($tipo == 'apagar') {
        
    }

    return $obj_response;
}
