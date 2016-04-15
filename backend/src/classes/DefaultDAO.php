<?php

interface DefaultDAO {

  const URL = 'https://educoltec.firebaseio.com';

  /**
   * Insere um objeto
   *
   * @param $object objeto a ser inserido
   */
  public function insert($object);

  /**
   * Exclui um objeto
   *
   * @param $object objeto a ser excluído
   */
  public function delete($id);


  /**
   *  Exclui todos os objetos
   */
  public function deleteAll();

  /**
   * Atualiza um objeto
   *
   * @param $object objeto a ser atualizado
   */
  public function update($object, $id);

  /**
   * Recupera um objeto pelo id
   *
   * @param $id id do objeto a ser recuperado
   */
  public function getById($id);

  /**
   * Recupera uma lista de objetos com base em um vetor de parâmetros
   *
   * @param $data vetor com parâmetros da pesquisa
   */
  public function getBy($data);

  /**
   * Recupera todos os elementos cadastrados
   */
  public function getAll();

}
