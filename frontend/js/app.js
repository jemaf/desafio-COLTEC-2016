var app = angular.module('eduCOLTEC', ['ngRoute']);

var hostAddress = '/backend/src/public/';



/**
 * Configuração das rotas
 */
app.config(['$routeProvider', function($routeProvider) {
$routeProvider.when('/',
      {
        templateUrl: 'templates/main.html',
        controller: "VideosController",
        controllerAs: "videosCtrl"
      }
    )
    .when('/novoVideo',
      {
        templateUrl: 'templates/newVideo.html',
        controller: "VideosController",
        controllerAs: "videosCtrl"
      }
    )
    .when('/novoComentario/:videoId',
      {
        templateUrl: 'templates/newComment.html',
        controller: "ComentariosController",
        controllerAs: "comentariosCtrl"
      }
    )
    .otherwise({redirectTo: '/'});
}]);


/**
 * Diretiva para funcionamento da modal.
 */
app.directive('materialmodal', [function() {
   return {
      restrict: 'A',
      link: function(scope, elem, attrs) {
        scope.$watch("videos", function() {
          $(elem).leanModal();
        });
      }
   };
}]);


/**
 * Filtro customizado para gerar intervalos
 */
app.filter('range', function() {
  return function(input, total) {
    total = parseInt(total);

    for (var i=0; i<total; i++) {
      input.push(i);
    }

    return input;
  };
});


/**
 * Serviço para manipulação dos objetos do serviço
 */
app.factory('Service', function($http) {
  var service = {};

  /**
   *  Função para tratar GET no serviço
   */
  service.get = function(url, callback) {
    $http.get(url).then(function(response) {
      var answer = response.data;
      callback(answer);
    });
  };


  /**
   *  Função para tratar POST no serviço
   */
  service.post = function(url, data, callback) {
    $http.post(url, data).then(function(response) {
      var answer = response.data;
      callback(answer);
    });
  };

  return service;
});


/**
 * Controller para manipulação dos vídeos
 *
 * @param service serviço de manipulação dos vídeos
 * @param $scope escopo do controller
 * @param $sce serviço para anexar url do vídeo
 */
app.controller('VideosController', ['$sce', '$scope', '$location', 'Service', function($sce, $scope, $location, service) {
  var self = this;
  self.videos = [];
  self.cursos = [];

  // recupera os vídeos
  service.get(hostAddress + 'videos', function(answer) {
    self.videos = answer;
    updateVideoCourse(0);
  });


  // recupera os cursos
  service.get(hostAddress + 'cursos', function(answer) {
    self.cursos = answer;
  });

  $scope.preencha = function(){
    Materialize.toast('Preencha todos os campos!', 3000, 'rounded');
  };

  // Função para compartilhar
  $scope.share = function(video){
     window.open('https://www.facebook.com/sharer/sharer.php?u=' + video.urlVideo, "_blank", "resizable=yes,top=500,left=500,width=600,height=400");
  };

  /**
   * método para atualizar url do vídeo da aula
   *
   * @param video a ser atualizado
   */
  $scope.getVideoUrl = function (video) {
    return $sce.trustAsResourceUrl(video.urlVideo);
  };


  /**
   *  Função para cadastro de novo vídeo
   *
   *  @param video novo video a ser cadastrado
   */
  $scope.newVideo = function(video) {
    video.cursoId = video.curso.id;
    if(video.titulo == null || video.disciplina == null || video.urlVideo == null || video.urlImagem == null || video.resumo == null) //if que confere se todos os campos essenciais foram preenchidos
      Materialize.toast('Preencha todos os campos!', 3000, 'rounded'); //alerta de erro
    else
      service.post(hostAddress + 'videos', video, function(answer) {
        if (answer.id !== null) {
          Materialize.toast('Cadastro de vídeo realizado com sucesso!', 3000, 'rounded'); //alerta de cadastro
          $location.path('/');
        }
      });
  }


  /**
   * Função para recuperação dos dados do curso do vídeo
   *
   * @param index indice do video que será atualizado
   */
  function updateVideoCourse(index) {
    if (index < self.videos.length) {
      service.get(self.videos[index].curso, function(answer) {
        self.videos[index].curso = answer;
        updateVideoComments(index, 0);
        updateVideoCourse(index + 1);
      });
    }
  }


  /**
   * Função para recuperação dos comentários da função do curso
   *
   * @param index indice do video que será atualizado
   */
  function updateVideoComments(videoIndex, commentIndex) {
    if (commentIndex < self.videos[videoIndex].comentarios.length) {
      service.get(self.videos[videoIndex].comentarios[commentIndex], function(answer) {
        self.videos[videoIndex].comentarios[commentIndex] = answer;
        updateVideoComments(videoIndex, commentIndex + 1);
      });
    }
  }
}]);



/**
 * Controller para manipulação dos comentários
 *
 * @param service serviço de manipulação dos vídeos
 */
app.controller('ComentariosController', ['$scope', 'Service', '$routeParams', '$location', function($scope, service, $routeParams, $location) {
  var self = this;
  self.video = [];
  $scope.coment = {};

  // recupera um vídeo específico com base no ID da url
  service.get(hostAddress + 'videos/' + $routeParams.videoId, function(answer) {
    self.video = answer;
  });

  /**
   *  Função para cadastro de novo comentario
   *
   */
  $scope.newComment = function(coment) {
    coment.videoId = $routeParams.videoId;
    if(coment.nota == null || coment.comentario == null)
      Materialize.toast('Preencha todos os campos!', 3000, 'rounded');
    else
    service.post(hostAddress + 'comentarios', coment, function(answer) {
      if(answer.id !== null){
        Materialize.toast('Comentario registrado com sucesso', 3000, 'rounded'); //popup avisando que o comentario foi registrado
          $location.path('/');
      }
    });
  }

}]);
