<?php
class VideoDAO
{

  const URL = 'https://educoltec.firebaseio.com';
  const PATH = '/videos';
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


  public function insert($object) {
    $novoVideo = new Video($object);
    $id = json_decode($this->firebase->push(self::PATH, null));
    $novoVideo->id = $id->name;
    $this->firebase->set(self::PATH . "/" . $novoVideo->id, $novoVideo);
    return $novoVideo;
  }


  public function delete($id) {
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
    $video = json_decode($this->firebase->get(self::PATH . "/" . $id));
    if ($video) {
      $video->curso = $object['curso'] ? $object['curso'] : $video->curso;
      $video->titulo = $object['titulo'] ? $object['titulo'] : $video->titulo;
      $video->urlVideo = $object['urlVideo'] ? $object['urlVideo'] : $video->urlVideo;
      $video->urlImagem = $object['urlImagem'] ? $object['urlImagem'] : $video->urlImagem;
      $video->resumo = $object['resumo'] ? $object['resumo'] : $video->resumo;
      $video->disciplina = $object['disciplina'] ? $object['disciplina'] : $video->disciplina;
      $this->firebase->set(self::PATH . "/" . $id, $video);
      return true;
    }

    return false;
  }


  public function getById($id) {
    return json_decode($this->firebase->get(self::PATH . "/" . $id));
  }


  public function getBy($data) {
    $allVideos = json_decode($this->firebase->get(self::PATH));
    return array_filter($allVideos, function($var) {
      return ($var->getId() == $data['id'] || $data['id'] === NULL) &&
      ($var->getCurso() == $data['curso'] || $data['curso'] === NULL) &&
      ($var->getTitulo() == $data['titulo'] || $data['titulo'] === NULL) &&
      ($var->getUrlVide() == $data['urlVideo'] || $data['urlVideo'] === NULL) &&
      ($var->getUrlImagem() == $data['urlImagem'] || $data['urlImagem'] === NULL) &&
      ($var->getResumo() == $data['resumo'] || $data['resumo'] === NULL) &&
      ($var->getDisciplina() == $data['disciplina'] || $data['disciplina'] === NULL);
    });
  }

  public function getAll() {
    return json_decode($this->firebase->get(self::PATH));
  }
}
