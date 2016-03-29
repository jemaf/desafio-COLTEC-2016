<?php

class ComentarioDAO implements DefaultDAO {

  private static $comentarios = [];


  public function insert($object) {
    if (!$comentarios[$object->id]) {
      $novoComentario = new Comentario($object);
      $comentarios[$novoComentario->id] = $novoComentario;

      return true;
    }

    return false;
  }


  public function delete($object) {
    if ($comentarios[$object->id]) {
      unset($comentarios[$object->id]);

      return true;
    }

    return false;
  }


  public function update($object) {
    $comentario = $comentarios[$object->id];

    if ($comentario) {
      $comentario->nota = $object->nota ? $object->nota : $comentario->nota;
      $comentario->comentario = $object->comentario ? $object->comentario : $comentario->comentario;
      $comentario->videoId = $object->videoId ? $object->videoId : $comentario->videoId;

      return true;
    }

    return false;
  }


  public function getById($id) {
    return $comentarios[$id];
  }


  public function getBy($data) {
    return array_filter($comentarios, function($var) {
      return ($var->id == $data->id || $data->id == NULL) &&
              ($var->nota == $data->nota || $data->nota == NULL) &&
              ($var->comentario == $data->comentario || $data->comentario == NULL) &&
              ($var->videoId == $data->videoId || $data->videoId == NULL);
    });
  }

}
