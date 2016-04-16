## O QUE FOI FEITO ALÉM DAS TAREFAS ##

### Uma função pra formatação de links do youtube: ###

 Para que o iframe funcione adequadamente os links deveriam ter o formato ww.youtube.com/embed/(codigo do vídeo) uma maneira mais simples de o fazê-lo seria salvar somente o código do vídeo, mas como esta função foi uma das  primeiras a serem feitas a mantive pois funciona bem;

### A divisão da home por cursos ###

Uma divisão simples para organizar a home;

### Uma aba especial para cada curso ###

Uma página que além de possuir um visual mais limpo, traz também uma imagem relacionada ao curso;

### Adição do campo Nota nos vídeos ###

Esta adição faz uso de uma função que faz a media das notas dadas em comentários no vídeo,caso não possua comentários não mostra o campo em questão;

### Adição do ordenador de vídeos ###

Este ordenador faz com que os vídeos sejam ordenados respectivamente por notas(campo novo), pelo inverso de notas, por id(ao ordenar pelo id, tem-se por consequência uma ordenação por data) e ordenação pelo inverso do id;

### Adição da função de deletar vídeos ###

Ao criar tal função, tive que implementar também as rotas para comunicação com o servidor, e também o processamento dos requests no servidor, além da própria modal de confirmação;
