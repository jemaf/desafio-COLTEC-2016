<?php

/**
 * Classe que manipula os vídeos
 */
class Video
{

  protected $id;
  protected $cursoId;
  protected $disciplina;
  protected $titulo;
  protected $urlVideo;
  protected $urlImagem;
  protected $resumo;

  /**
   * Recebe um vetor com os parâmetros e cria o objeto
   *
   *  @param array $data vetor com os parâmetros
   */
  function __construct(array $data) {
    // no id if we're creating
    if(isset($data['id'])) {
       $this->id = $data['id'];
    }
    $this->cursoId = $data['cursoId'];
    $this->titulo = $data['disciplina'];
    $this->urlVideo = $data['urlVideo'];
    $this->urlImagem = $data['urlImagem'];
    $this->resumo = $data['resumo'];
    $this->disciplina = $data['disciplina'];
  }


  /**
   * Get the value of Classe que manipula os vídeos
   *
   * @return mixed
   */
  public function getId()
  {
      return $this->id;
  }

  /**
   * Get the value of cursoId
   *
   * @return mixed
   */
  public function getCursoId()
  {
      return $this->cursoId;
  }

  /**
   * Get the value of Disciplina
   *
   * @return mixed
   */
  public function getDisciplina()
  {
      return $this->disciplina;
  }

  /**
   * Get the value of Titulo
   *
   * @return mixed
   */
  public function getTitulo()
  {
      return $this->titulo;
  }

  /**
   * Get the value of Url Video
   *
   * @return mixed
   */
  public function getUrlVideo()
  {
      return $this->urlVideo;
  }

  /**
   * Get the value of Url Imagem
   *
   * @return mixed
   */
  public function getUrlImagem()
  {
      return $this->urlImagem;
  }

  /**
   * Get the value of Resumo
   *
   * @return mixed
   */
  public function getResumo()
  {
      return $this->resumo;
  }
}
