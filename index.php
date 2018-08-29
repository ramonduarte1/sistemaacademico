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
        require_once './autoload.php';
        $pes = 'ra';
        $con = new Conexao();
        $sql = "SELECT * FROM aluno where nome like '%$pes%' ";
        $perfilSelect = $con->query($sql)->fetchAll(PDO::FETCH_ASSOC);

        foreach ($perfilSelect as $value) {
            echo $value['nome'];
        }
            ?>
    </body>
</html>
