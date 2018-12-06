<?php

class Conexao extends PDO {

    private $tipo;
    private $host;
    private $database;
    private $user;
    private $pass;

    function __construct() {
        $this->tipo = 'pgsql';
        $this->host = '127.0.0.1';
        $this->database = 'sistema_academico';
        $this->user = 'postgres';
        $this->pass = '****';
        $dns = $this->tipo . ':dbname=' . $this->database . ";host=" . $this->host;
        parent::__construct($dns, $this->user, $this->pass, null);
    }

}
