<?php

class CursoDAO implements DefaultDAO
{

  private static $cursos = [];

  public function insert($object) {

    if (!$cursos[$object->id]) {
      $novoCurso = new Curso($object);
      $cursos[$novoCurso->id] = $novoCurso;

      return true;
    }

    return false;
  }


  public function delete($object) {

    if ($cursos[$object->id]) {
      unset($cursos[$object->id]);
      return true;
    }

    return false;
  }


  public function update($object) {
    $curso = $cursos[$object->id];

    if ($curso) {
      $curso->nome = $object->nome ? $object->nome : $curso->nome;
      return true;
    }
    
    return false;
  }


  public function getById($id) {
    return $cursos[$id];
  }


  public function getBy($data) {
    return array_filter($cursos, function($var) {
      return ($var->id == $data->id || $data->id == NULL) &&
              ($var->nome == $data->nome || $data->nome == NULL);
    });
  }
}
