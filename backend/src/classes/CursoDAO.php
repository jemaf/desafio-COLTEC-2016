<?php

class CursoDAO implements DefaultDAO
{

  private static $cursos = null;

  function __construct() {

    if (!CursoDAO::$cursos) {
      CursoDAO::$cursos = array('1' => new Curso(
                array('id' => '1', 'nome' => 'Análises Clínicas')),
                      '2' => new Curso(array('id' => '2', 'nome' => 'Automação')),
                      '3' => new Curso(array('id' => '3', 'nome' => 'Eletrônica')),
                      '4' => new Curso(array('id' => '4', 'nome' => 'Informática')),
                      '5' => new Curso(array('id' => '5', 'nome' => 'Química'))
                );
    }
  }


  public function insert($object) {
    if (!CursoDAO::$cursos[$object->id]) {
      $novoCurso = new Curso($object);
      CursoDAO::$cursos[$novoCurso->id] = $novoCurso;

      return true;
    }

    return false;
  }


  public function delete($object) {

    if (CursoDAO::$cursos[$object->id]) {
      unset(CursoDAO::$cursos[$object->id]);
      return true;
    }

    return false;
  }


  public function update($object) {
    $curso = CursoDAO::$cursos[$object->id];

    if ($curso) {
      $curso->nome = $object->nome ? $object->nome : $curso->nome;
      return true;
    }

    return false;
  }


  public function getById($id) {
    return CursoDAO::$cursos[$id];
  }


  public function getBy($data) {
    return array_filter(CursoDAO::$cursos, function($var) {
      return ($var->id == $data->id || $data->id == NULL) &&
              ($var->nome == $data->nome || $data->nome == NULL);
    });
  }


  public function getAll() {
    return CursoDAO::$cursos;
  }
}
