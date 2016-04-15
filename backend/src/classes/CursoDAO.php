<?php
// begin the session
session_start();

class CursoDAO
{
  const URL = 'https://educoltec.firebaseio.com';
  const PATH = '/cursos';
  private $firebase;

  private function __construct() {
    $this->firebase = new \Firebase\FirebaseLib(self::URL);
  }


  public static function getInstance() {
    static $instance = null;
    if (null === $instance) {
        $instance = new static();
    }
    return $instance;
  }

  public function getById($id) {
    return json_decode($this->firebase->get(self::PATH . "/" . $id));
  }


  public function getBy($data) {
    $allCursos = json_decode($this->firebase->get(self::PATH));
    return array_filter($allCursos, function($var) {
      return ($var->getId() == $data['id'] || $data['id'] === NULL) &&
              ($var->getNome() == $data['nome'] || $data['nome'] === NULL);
    });
  }


  public function getAll() {
    return json_decode($this->firebase->get(self::PATH));
  }
}
