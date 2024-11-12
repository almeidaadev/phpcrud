<?php

class Connection {
  public  mysqli $mysqli;
  private string $HOST =  "localhost";
  private string $USER = "root";
  private string $PASS = "";
  private string $DBSA = "informacoes";
  private $instance;

  public function connect() {
    $this->instance = new mysqli($this->HOST, $this->USER, $this->PASS, $this->DBSA);
    if ($this->mysqli->connect_error) {
      die($this->mysqli->connect_error);
    } else {
      echo "Conectado";
    }
    $this->instance->set_charset('utf8');

    return $this->instance;
  }
}
