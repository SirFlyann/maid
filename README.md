#Maid

---
![Alt text](http://3.bp.blogspot.com/-9w9oY1hohbw/T7u6OX2q_FI/AAAAAAAABlA/RC3KdvYCCpY/s1600/Chibi_Maid_2.jpg)

##  O que é

Maid é uma CLI que irá facilitar a criação de uma loja com PrestaShop a partir de um repositório base.

## Instalação

1. Clone este repositório utilizando:
```sh
$ git clone https://bitbucket.org/bettacommerce/maid
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

Por exemplo:
```sh
$ maid pull https://bitbucket.org/bettacommerce/lojabase-warehouse /var/www/html/minha-loja https://bitbucket.org/bettacommerce/minha-loja
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


Copyright (c) 2017 BettaCommerce
