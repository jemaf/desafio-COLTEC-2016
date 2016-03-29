<?php

class VideoDAO implements DefaultDAO
{

  private static $videos = [];

  public function insert($object) {

    $novoVideo = new Video($object);
    if (!$videos[$novoVideo->id]) {
      $videos[$novoVideo->id] = $novoVideo;
      return true;
    }

    return false;
  }


  public function delete($object) {
    if ($videos[$object->id]) {
      unset($videos[$object->id]);
      return true;
    }

    return false;
  }


  public function update($object) {
    $video = $videos[$object->id];

    if ($video) {
      $video->nota = $object->nota ? $object->nota : $video->nota;
      $video->cursoId = $object->cursoId ? $object->cursoId : $video->cursoId;
      $video->titulo = $object->titulo ? $object->titulo : $video->titulo;
      $video->urlVideo = $object->urlVideo ? $object->urlVideo : $video->urlVideo;
      $video->urlImagem = $object->urlImagem ? $object->urlImagem : $video->urlImagem;
      $video->resumo = $object->resumo ? $object->resumo : $video->resumo;
      $video->disciplina = $object->disciplina ? $object->disciplina : $video->disciplina;

      return true;
    }

    return false;
  }


  public function getById($id) {
    return $videos[$id];
  }


  public function getBy($data) {
    return array_filter($videos, function($var) {
      return ($var->id == $data->id || $data->id == NULL) &&
              ($var->nota == $data->nota || $data->nota == NULL) &&
              ($var->video == $data->video || $data->video == NULL) &&
              ($var->videoId == $data->videoId || $data->videoId == NULL);
    });
  }
}
