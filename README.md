#Maid

---
![Alt text](http://3.bp.blogspot.com/-9w9oY1hohbw/T7u6OX2q_FI/AAAAAAAABlA/RC3KdvYCCpY/s1600/Chibi_Maid_2.jpg)

##  O que é

Maid é uma CLI que irá facilitar a criação de uma loja com PrestaShop a partir de um repositório base.

## Instalação

1. Clone este repositório utilizando:
```sh
$ git clone https://github.com/SirFlyann/maid
```

2. Copie o arquivo maid.phar para que ele possa ser acessado de qualquer lugar
```sh
$ sudo cp maid/maid.phar /usr/local/bin/maid
```

## Comandos

#### maid pull
maid pull serve para clonar um repositório Git

Pode receber três parâmetros:

1. Url do repositório de origem (Obrigatório)
2. Caminho do repositório (Opcional)
3. Url do repositório para onde a nova loja vai apontar (Opcional)

#### maid make:database
maid make:database serve para criar um novo banco de dados

Pode receber quatro parâmetros:

1. Nome do banco de dados (Obrigatório).
2. Usuário do banco de dados (Opcional). Padrão: 'root'
3. Senha do banco de dados (Opcional). Padrão: 123
4. Servidor do banco de dados (Opcional). Padrão 'localhost'

Por exemplo:
```sh
$ maid make:database dbTeste root 123 localhost
```

#### maid make:database
maid run:dump serve para executar um dump sql em um banco de dados

Pode receber cinco parâmetros:

1. Caminho do dump (Obrigatório).
2. Nome do banco de dados (Obrigatório).
3. Usuário do banco de dados (Opcional). Padrão: 'root'
4. Senha do banco de dados (Opcional). Padrão: 123
5. Servidor do banco de dados (Opcional). Padrão 'localhost'

Por exemplo:
```sh
$ maid run:dump /var/www/html/dump-dbTeste.sql dbTeste root 123 localhost
```

#### maid setup:database
maid setup:database serve para criar um banco de dados e executar um dump sql nele

Pode receber cinco parâmetros:

1. Caminho do dump (Obrigatório).
2. Nome do banco de dados (Obrigatório).
3. Usuário do banco de dados (Opcional). Padrão: 'root'
4. Senha do banco de dados (Opcional). Padrão: 123
5. Servidor do banco de dados (Opcional). Padrão 'localhost'

Por exemplo:
```sh
$ maid setup:database /var/www/html/dump-dbTeste.sql dbTeste root 123 localhost
```

maid setup:database é uma união dos comandos maid make:database e maid run:dump

#### maid setup:vhost
maid setup:vhost serve para criar virtual hosts

Pode receber três parâmetros:

1. Nome do virtual host (Obrigatório).
2. Caminho da raiz do projeto (Opcional). Padrão: '/var/www/html/[nome do virtual host]'
3. Caminho personalizado do apache (Opcional). Padrão: '/etc/apache2/sites-available/'

Também pode receber estas opções:
1. A opção --local (abreviação --l) serve para definir o domínio como .dev
2. A opção --domain (abreviação --d) serve para definir qualquer outro domínio

Se as duas opções forem utilizadas, o domínio será ".dev".

Por exemplo:
```sh
$ maid setup:vhost teste --local
```
ou
```sh
$ maid setup:vhost teste --domain=meusite.com.br
```

#### maid setup:store
maid setup:store serve para criar as pastas necessárias de um projeto PrestaShop. Ele deve ser rodado na raiz do projeto.

Pode receber quatro parâmetros:

1. Nome do banco de dados (Opcional). Padrão 'dbLojaBase'
2. Nome do usuário do banco de dados (Opcional). Padrão: 'root'
3. Senha do banco de dados (Opcional). Padrão: 123
4. Servidor do banco de dados (Opcional). Padrão: 'localhost'

Por exemplo:
```sh
$ cd minha-loja

$ maid setup:store dbLojaBase root 123 localhost
```

#### maid setup:module
maid setup:module serve para criar a estrutura de um novo módulo do PrestaShop.

Pode receber dois parâmetros:

1. Nome do módulo. Se este parâmetro não estiver em CamelCase, a primeira letra será capitalizada. (Obrigatório).
2. Nome da model do módulo. (Opcional)

Por exemplo:
```sh
$ maid setup:module MeuModulo ModuloModel
```


Copyright (c) 2017 Mahezer Carvalho
