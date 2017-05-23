#Maid

---
![Alt text](http://www.magic4walls.com/wp-content/uploads/2016/04/warrior-woman-with-sword-and-shield-on-fire-background.jpg)

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

#### maid setup
maid setup serve para criar as pastas necessárias de um projeto PrestaShop. Ele deve ser rodado na raiz do projeto.

Recebe quatro parâmetros:

1. Nome do banco de dados (Opcional). Padrão 'dbLojaBase'
2. Nome do usuário do banco de dados (Opcional). Padrão: 'root'
3. Senha do banco de dados (Opcional). Padrão: 123
4. Servidor do banco de dados (Opcional). Padrão: 'localhost'

Por exemplo:
```sh
$ cd minha-loja

$ maid setup dbMinhaLoja admin 1234 192.0.0.0
```


Copyright (c) 2017 BettaCommerce
