<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
session_start();
unset($_SESSION['login']);
unset($_SESSION['senha']);
echo "<script>location.href=\"../index.php\"</script> ";
