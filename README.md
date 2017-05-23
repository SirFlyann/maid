#Maid

---
<div style="text-align: center" markdown="1">

![Alt text](https://staticdelivery.nexusmods.com/images/110/1207799-1336888570.jpg)

</div>

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
```sh
$ maid pull
```
recebe três parâmetros:

1. Url do repositório de origem (Obrigatório)
2. Caminho do repositório (Opcional)
3. Url do repositório para onde a nova loja vai apontar (Opcional)

Por exemplo:
```sh
$ maid pull https://bitbucket.org/bettacommerce/lojabase-warehouse /var/www/html/minha-loja https://bitbucket.org/bettacommerce/minha-loja
```

#### maid setup
```sh
$ maid setup
```
recebe quatro parâmetros:

1. Nome do banco de dados (Opcional). Padrão 'dbLojaBase'
2. Nome do usuário do banco de dados (Opcional). Padrão: 'root'
3. Senha do banco de dados (Opcional). Padrão: 123
4. Servidor do banco de dados (Opcional). Padrão: 'localhost'

Por exemplo:
```sh
$ maid setup dbMinhaLoja admin 1234 192.0.0.0
```


Copyright (c) 2017 BettaCommerce
