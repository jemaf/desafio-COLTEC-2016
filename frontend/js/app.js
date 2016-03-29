var app = angular.module('eduCOLTEC', []);

app.filter('range', function() {
  return function(input, total) {
    total = parseInt(total);

    for (var i=0; i<total; i++) {
      input.push(i);
    }

    return input;
  };
});

app.controller('CursosController', function(){
  this.cursos = [
    {id: 0, nome: 'Informática'},
    {id: 1, nome: 'Eletrônica'},
    {id: 2, nome: 'Automação'},
    {id: 3, nome: 'Química'},
    {id: 4, nome: 'Análises Clínicas'}
  ];
});

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
      resumo: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
      comentarios: [
        { id: 0, nota: 3, comentario: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.' },
        { id: 1, nota: 1, comentario: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.' }
      ]
    },
    {
      id: 1,
      curso: 0,
      disciplina: 'Introdução a Programação',
      titulo: 'Estruturas de Repetição',
      url: 'http://www.youtube.com/embed/nKIu9yen5nc',
      imagem: 'http://lorempixel.com/800/500/technics/',
      resumo: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
      comentarios: [
        { id: 0, nota: 3, comentario: 'Gostei' },
        { id: 1, nota: 1, comentario: 'Não gostei' }
      ]
    },
    {
      id: 2,
      curso: 0,
      disciplina: 'Introdução a Programação',
      titulo: 'Funções',
      url: 'http://www.youtube.com/embed/nKIu9yen5nc',
      imagem: 'http://lorempixel.com/800/500/technics/',
      resumo: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
      comentarios: [
        { id: 0, nota: 3, comentario: 'Gostei' },
        { id: 1, nota: 1, comentario: 'Não gostei' }
      ]
    },
    {
      id: 3,
      curso: 0,
      disciplina: 'Introdução a Programação',
      titulo: 'Structs',
      url: 'http://www.youtube.com/embed/nKIu9yen5nc',
      imagem: 'http://lorempixel.com/800/500/technics/',
      resumo: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
      comentarios: [
        { id: 0, nota: 3, comentario: 'Gostei' },
        { id: 1, nota: 1, comentario: 'Não gostei' }
      ]
    },
    {
      id: 4,
      curso: 0,
      disciplina: 'Desenvolvimento de Aplicações Web',
      titulo: 'Angular JS',
      url: 'http://www.youtube.com/embed/nKIu9yen5nc',
      imagem: 'http://lorempixel.com/800/500/technics/',
      resumo: 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
      comentarios: [
        { id: 0, nota: 3, comentario: 'Gostei' },
        { id: 1, nota: 1, comentario: 'Não gostei' }
      ]
    }
  ];

  $scope.getVideoUrl = function (video) {
      return $sce.trustAsResourceUrl(video.url);
    }
});
