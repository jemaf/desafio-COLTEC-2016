<?php

/**
 *  Classe que lida com os comentários dos vídeos
 */
class Resposta
{

  public $id;
  public $resposta;
  private $comentarioId;

  /**
   * Construtor que recebe o vetor de data com os parâmetros da resposta
   *
   * @param array $data vetor com os parâmetros da resposta a ser preenchida
   */
  function __construct(array $data)
  {
    $this->id = $data['id'];
    $this->comentarioId = $data['comentaerioId'];
    $this->resposta = $data['resposta'];
  }

  /**
   * Get the value of id
   *
   * @return mixed
   */
  public function getId()
  {
      return $this->id;
  }

  /**
   * Get the value of resposta
   *
   * @return mixed
   */
  public function getResposta()
  {
      return $this->resposta;
  }

  /**
   * Get the value of Comantário Id
   *
   * @return mixed
   */
  public function getComentarioId()
  {
      return $this->comentarioId;
  }
}
