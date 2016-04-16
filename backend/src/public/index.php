<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';

// Carregamento dos arquivos fonte do projeto
spl_autoload_register(function ($classname) {
  require ("../classes/" . $classname . ".php");
});

$app = new \Slim\App;
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

/**
* ---------------------------------------------------------------------------
* ------------------------- ROTAS PARA CURSOS -------------------------
* ---------------------------------------------------------------------------
*/

/**
* Rota para recuperar todos os cursos
*/
$app->get('/cursos', function (Request $request, Response $response) {
  $cursoDAO = CursoDAO::getInstance();
  $cursos = array_values($cursoDAO->getAll());

  return $response->withJson($cursos);
});


/**
* Rota para recuperar um curso específico
*
*  @param $args vetor com id para ser buscado
*/
$app->get('/cursos/{id}', function (Request $request, Response $response, $args) {
  $id = $args['id'];
  $cursoDAO = CursoDAO::getInstance();
  $cursos = $cursoDAO->getById($id);

  return $response->withJson($cursos);
});


/**
* ---------------------------------------------------------------------------
* ------------------------- ROTAS PARA VIDEOS -------------------------
* ---------------------------------------------------------------------------
*/

/**
* Rota para cadastrar um vídeo.
*
* Campos do vídeo são enviados no body da requisição como JSON.
*/
$app->post('/videos', function (Request $request, Response $response) {
  $data = $request->getParsedBody();

  /**
  *  Checa se a URL do vídeo é do Youtube e tenta extrair o ID dele. Olha que regex lindo
  *
  */
  $pattern = '#^(?:https?://)?';    # Either http or https.
  $pattern .= '(?:www\.)?';         # Optional www subdomain.
  $pattern .= '(?:';                # Group host alternatives:
  $pattern .=   'youtu\.be/';       #    Either youtu.be,
  $pattern .=   '|youtube\.com';    #    or youtube.com
  $pattern .=   '(?:';              #    Group path alternatives:
  $pattern .=     '/embed/';        #      Either /embed/,
  $pattern .=     '|/v/';           #      or /v/,
  $pattern .=     '|/watch\?v=';    #      or /watch?v=,
  $pattern .=     '|/watch\?.+&v='; #      or /watch?other_param&v=
  $pattern .=   ')';                #    End path alternatives.
  $pattern .= ')';                  #  End host alternatives.
  $pattern .= '([\w-]{11})';        # 11 characters (Length of Youtube video ids).
  $pattern .= '(?:.+)?$#x';         # Optional other ending URL parameters.
  preg_match($pattern, $data['urlVideo'], $matches);
  $parsedVid = isset($matches[1]) ? $matches[1] : FALSE;
  if($parsedVid===FALSE)
    return $response->withJson(array("message" => "Erro: vídeo inválido!"));
  else $data['urlVideo'] = "https://www.youtube.com/v/" . $parsedVid;

  /**
  *  Checa se a URL da imagem é válida
  *
  */
  $imageType = exif_imagetype($data['urlImagem']);
  if($imageType != IMAGETYPE_GIF && $imageType != IMAGETYPE_JPEG && $imageType != IMAGETYPE_PNG)
    return $response->withJson(array("message" => "Erro: imagem inválida!"));

  $videoDAO = VideoDAO::getInstance();
  $result = $videoDAO->insert($data);

  if ($result) {
    $newVideo = $videoDAO->getById($result->id);
    return $response->withJson($newVideo);
  } else {
    $response->setStatusCode(400);
    return $response->withJson(array("message" => "Erro durante cadastro de novo vídeo"));
  }
});

/**
* Rota para recuperar todos os vídeos
*/
$app->get('/videos', function (Request $request, Response $response) {
  $videoDAO = VideoDAO::getInstance();
  $videos = $videoDAO->getAll();
  return $response->withJson($videos);
});


/**
* Rota para recuperar um vídeo específico
*
*  @param $args vetor com id para ser buscado
*/
$app->get('/videos/{id}', function (Request $request, Response $response, $args) {
  $videoDAO = VideoDAO::getInstance();
  $video = $videoDAO->getById($args['id']);
  return $response->withJson($video);
});


/**
* Rota para Excluir todos os vídeos
*/
$app->delete('/videos', function (Request $request, Response $response){
  $videoDAO = VideoDAO::getInstance();
  $videoDAO->deleteAll();

  return $response->withJson(array("message" => "Vídeos excluídos com sucesso"));
});

/**
* Rota para editar um video
*/
$app->put('/videos/{id}', function (Request $request, Response $response, $args) {
  $data = $request->getParsedBody();
  $videoDAO = VideoDAO::getInstance();
  $update = $videoDAO->update($data, $args['id']);
  if($update)
  return $response->withJson(array("message" => "Vídeo editado com sucesso"));
  return $response->withJson(array("message" => "Erro na edição do vídeo"));
});

/**
* Rota para excluir um video específico
*/
$app->delete('/videos/{id}', function (Request $request, Response $response, $args) {
  $videoDAO = VideoDAO::getInstance();
  $videoDAO->delete($args['id']);
  return $response->withJson(array("message" => "Vídeo deletado"));
});

/**
* ---------------------------------------------------------------------------
* ------------------------- ROTAS PARA COMENTARIOS -------------------------
* ---------------------------------------------------------------------------
*/

/**
* Rota para recuperar todos os comentários
*/
$app->get('/comentarios', function (Request $request, Response $response) {
  $comentarioDAO = ComentarioDAO::getInstance();
  $comentarios = array_values($comentarioDAO->getAll());


  // Adiciona URL para o vídeo relacionado ao comentário
  $uri = $request->getUri();
  $videoURL = $uri->getScheme() . '://' . $uri->getHost() . ':' . $uri->getPort() . $uri->getBasePath() . '/videos/';

  $videoDAO = VideoDAO::getInstance();
  foreach ($comentarios as &$comentario) {
    $video = $videoDAO->getById($comentario->getId());
    $comentario->video = $videoURL . "" . $video->getId();
  }


  return $response->withJson($comentarios);
});


/**
* Rota para recuperar um comentário por seu id
*
* @param id id do comentario a ser recuperado
*/
$app->get('/comentarios/{id}', function (Request $request, Response $response, $args) {
  $id = $args['id'];
  $comentarioDAO = ComentarioDAO::getInstance();
  $comentario = $comentarioDAO->getById($id);

  return $response->withJson($comentario);
});


/**
* Rota para salvar um comentário.
*
* Campos do comentário são enviados no body da requisição como JSON.
*/
$app->post('/comentarios/{vidId}', function (Request $request, Response $response, $args) {
  $data = $request->getParsedBody();
  $vidId = $args['vidId'];

  $comentarioDAO = ComentarioDAO::getInstance();
  $result = $comentarioDAO->insert($data, $vidId);

  if ($result) {
    $newComentario = $comentarioDAO->getById($result->id);
    return $response->withJson($newComentario);
  } else {
    $response->setStatusCode(400);
    return $response->withJson(array("message" => "Erro durante cadastro de novo comentario"));
  }
});


/**
* Rota para excluir todos os comentários
*/
$app->delete('/comentarios', function (Request $request, Response $response){
  $comentarioDAO = ComentarioDAO::getInstance();
  $comentarioDAO->deleteAll();

  return $response->withJson(array("message" => "Comentários excluídos com sucesso"));
});

$app->run();
