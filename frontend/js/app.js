var app = angular.module('eduCOLTEC', []);

app.controller('VideosController', function($sce, $scope) {
  this.cursos = [
    'Informática',
    'Eletrônica',
    'Automação',
    'Química',
    'Análises Clínicas'
  ];
  this.videos = [
    {
      id: 0,
      curso: 0,
      disciplina: 'Introdução a Programação',
      titulo: 'Estruturas Condicionais',
      url: 'http://www.youtube.com/embed/nKIu9yen5nc',
      imagem: 'http://lorempixel.com/800/500/technics/',
      resumo: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
    },
    {
      id: 1,
      curso: 0,
      disciplina: 'Introdução a Programação',
      titulo: 'Estruturas de Repetição',
      url: 'http://www.youtube.com/embed/nKIu9yen5nc',
      imagem: 'http://lorempixel.com/800/500/technics/',
      resumo: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
    },
    {
      id: 2,
      curso: 0,
      disciplina: 'Introdução a Programação',
      titulo: 'Funções',
      url: 'http://www.youtube.com/embed/nKIu9yen5nc',
      imagem: 'http://lorempixel.com/800/500/technics/',
      resumo: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
    },
    {
      id: 3,
      curso: 0,
      disciplina: 'Introdução a Programação',
      titulo: 'Structs',
      url: 'http://www.youtube.com/embed/nKIu9yen5nc',
      imagem: 'http://lorempixel.com/800/500/technics/',
      resumo: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
    },
    {
      id: 4,
      curso: 0,
      disciplina: 'Desenvolvimento de Aplicações Web',
      titulo: 'Angular JS',
      url: 'http://www.youtube.com/embed/nKIu9yen5nc',
      imagem: 'http://lorempixel.com/800/500/technics/',
      resumo: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.'
    }
  ];

  $scope.getVideoUrl = function (video) {
      return $sce.trustAsResourceUrl(video.url);
    }
});
