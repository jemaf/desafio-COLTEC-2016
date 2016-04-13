<?php

class RespostaDAO implements DefaultDAO {

  private function __construct() {
    if (!isset($_SESSION["respostas"])) {
      $_SESSION["respostas"] = [];
    }
  }


  public static function getInstance() {
        static $instance = null;
        if (null === $instance) {
            $instance = new static();
        }

        return $instance;
  }


  public function insert($object) {
    $novaResposta = new Resposta($object);
    $novaResposta->id = count($_SESSION["respostas"]);
    $_SESSION["respostas"][] = $novaResposta;

    return $novaResposta;
  }


  public function delete($object) {
    if ($_SESSION["respostas"][$object->id]) {
      unset($_SESSION["respostas"][$object->id]);

      return true;
    }

    return false;
  }


  public function deleteAll() {
    $_SESSION["respostas"] = [];
  }


  public function update($object) {
    $resposta = $_SESSION["respostas"][$object->id];

    if ($resposta) {

      $resposta->resposta = $object->resposta ? $object->resposta : $resposta->resposta;
      $resposta->comentarioId = $object->comentarioId ? $object->comentarioId : $resposta->comentarioId;

      return true;
    }

    return false;
  }


  public function getById($id) {
    return $_SESSION["respostas"][$id];
  }


  public function getBy($data) {
    return array_filter($_SESSION["respostas"], function($var) use($data) {
      return
              ($var->getId() == $data['id'] || $data['id'] === NULL) &&
              ($var->getNota() == $data['nota'] || $data['nota'] === NULL) &&
              ($var->getComentario() == $data['comentario'] || $data['comentario'] === NULL) &&
              ($var->getVideoId() == $data['videoId'] || $data['videoId'] === NULL);
    });
  }


  public function getAll() {
    return $_SESSION["respostas"];
  }
}
