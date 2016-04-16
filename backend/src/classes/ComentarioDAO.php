<?php

class ComentarioDAO {

  const URL = 'https://educoltec.firebaseio.com';
  const PATH = '/videos/';
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


  public function insert($object, $vidId) {
    $novoComentario = new Comentario($object);
    $id = json_decode($this->firebase->push(self::PATH . $vidId . "/comentarios", null));
    $novoComentario->id = $id->name;
    $this->firebase->set(self::PATH . $vidId . "/comentarios/" . $novoComentario->id, $novoComentario);
    return $novoComentario;
  }


  public function delete($object) {
    if ($firebase->get(self::PATH . "/" . $id)) {
      $firebase->delete(self::PATH . "/" . $id);
      return true;
    }
    return false;
  }


  public function deleteAll() {
    $firebase->delete(self::PATH);
  }

  public function update($object, $id) {
    $comentario = json_decode($this->firebase->get(self::PATH . "/" . $id));

    if ($comentario) {
      $comentario->nota = $object->nota ? $object->nota : $comentario->nota;
      $comentario->comentario = $object->comentario ? $object->comentario : $comentario->comentario;
      $comentario->videoId = $object->videoId ? $object->videoId : $comentario->videoId;

      return true;
    }

    return false;
  }


  public function getById($id) {
    return $this->firebase->get(self::PATH . "/" . $id);
  }


  public function getBy($data) {
    $allComments = json_decode($this->firebase->get(self::PATH), true);
    return array_filter($allComments, function($var) use($data) {
      return
      ($var->getId() == $data['id'] || $data['id'] === NULL) &&
      ($var->getNota() == $data['nota'] || $data['nota'] === NULL) &&
      ($var->getComentario() == $data['comentario'] || $data['comentario'] === NULL) &&
      ($var->getVideoId() == $data['videoId'] || $data['videoId'] === NULL);
    });
  }


  public function getAll() {
    return json_decode($this->firebase->get(self::PATH), true);
  }
}
