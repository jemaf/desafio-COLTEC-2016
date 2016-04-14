> Não kibem pls

## O Portal eduCOLTEC

O portal eduCOLTEC é um site de disponibilização e compartilhamento de conteúdo, disponiblizado no formato de vídeo. Usuários podem acessar o portal para assistir aos vídeos cadastrados e, se desejarem, comentar a respeito do vído que foi visto. Ainda, os usuários podem adicionar novos vídos, caso achem necessário.

Estruturalmente, o site possui três módulos principais:

* **Cadastro de vídeos:** Permite o cadastramento de novos vídeos no portal
* **Cadastro de comentários:** Permite o cadastramento de novos comentários relacionados a um vídeo
* **Listagem de vídeos:** Listagem dos vídeos cadastrados junto de seus comentários

Cada módulo possui uma URL própria, podendo ser acessado conforme Tabela abaixo:

| URL                  | Funcionalidade                                                 |
|----------------------|----------------------------------------------------------------|
| `/`                    | Listagem dos vídeos existentes                                 |
| `/novoVideo`           | Cadastro de novo vídeo                                         |
| `/novoComentario/:vid` | Cadastro de novo comentário pertencente a um vídeo de id = vid |

## Como executo meu projeto?


Para executar o projeto, você deverá navegar para a pasta raiz do projeto, e então utilizar o servidor built-in do PHP para executar o projeto. Você pode executar o servidor built-in por meio do seguinte comando:

```
php -e -S localhost:8000
```

**OBS: Você precisa ter o interpretador do PHP 5.4 ou superior instalado na máquina.**

Esse comando irá criar um servidor virtual com base nos arquivos do diretório onde o comando foi executado (no nosso caso, todo o projeto).

Uma vez executado o comando, você poderá acessar o site por meio da URL `http://localhost:8000/frontend/#/`.

### Para testar (após iniciar o server standalone do PHP):

[![Run in Postman](https://run.pstmn.io/button.svg)](https://app.getpostman.com/run-collection/753c12cf3eef5ef169be)
