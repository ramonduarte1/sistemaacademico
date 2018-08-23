<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        <form name = "form1" method = "post"> ...</form>
        <form name = "form2" method = "post"> ...</form>
        <input type = "button" value = "Fomu1" onClick = "document.form1.submit()">
        <input type = "button" value = "Fomu2" onClick = "document.form2.submit()">Só tem um detalhe cara, você não pode colocar um form dentro do outro, não em tags, pois acontece o seguinte:<form> <!--abre o 1º form --> <form> <!--não abre o 2º form, aqui o html não reconhece a tag, pois já foi aberta --> </form> <!--aqui você acaba de matar o html. Se não reconheceu o 2º form, advinha qual você fechou? --></form> <!--esta tag ficará sobrando -->É isso ae!Para fazer comunicação entre os forms, use funções, elas podem estar até fora dos forms:function qualquer($var_de_entrada){ $var_de_entrada .= 'juntar as strings';
        return $var_de_entrada;
        }<form name = "form" method = "post"> if(nanana){ $dados = 'Eu vou';
        function qualquer($dados);
        echo $dados; //imprimirá Eu vou juntar as strings   }</form>
        ?>
    </body>
</html>
