<?php
class Usuario {
    public $username;
    public $password;
    public $nombreCompleto;

    public function __construct($username, $password, $nombreCompleto) {
        $this->username = $username;
        $this->password = $password;
        $this->nombreCompleto = $nombreCompleto;
    }
}
?>