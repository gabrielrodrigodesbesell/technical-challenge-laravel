Desafio técnico para vaga de Programador PHP Pleno realizado em Abril de 2023. 

Demonstração do sistema: https://www.youtube.com/watch?v=nF5LlPknBkM

# Deploy

Faça o clone do repositório:
```sh
git clone https://github.com/gabrielrodrigodesbesell/technical-challenge-laravel.git .
```

Para subir a aplicação WEB, na raiz do projeto execute:
```sh
sudo chmod -R 775 web/ && cd web/ && docker-compose up -d && docker-compose exec app bash
```
Após terminar a execução do comando acima, você vai estar dentro do container app, então execute:
```sh
composer install && php artisan key:generate && php artisan migrate
```

Para subir o ambiente da API, na raiz do projeto execute:
```sh
sudo chmod -R 775 api/ && cd api/ && docker-compose up -d && docker-compose exec api bash
```
Após terminar a execução do comando acima, você vai estar dentro do container api, então execute:
```sh
composer install && php artisan key:generate && php artisan migrate
```

Inserir um CEP diretamente na API, abra o terminal do seu computador e execute o código abaixo, modificando o endereco de IP para o seu:
```sh
curl --request POST \
  --url http://192.168.53.6:9999/api/v1/ceps \
  --header 'Content-Type: application/json' \
  --data '{"cep": 89910000,"rua": "Av Getulio Vargas","cidade": "Descanso","estado": "SC"}'
```

Como o projeto é para nível de avaliação interna os arquivos .env das pastas api e web já estão pré prontos por conveniência e foram trackeados pelo git. 
Você precisa modificar nos dois arquivos .env somente o endereço da aplicação e da api. 
Onde encontrar o IP 192.168.53.6 modifique para o seu IP da sua máquina host. Esse passo é necessário para que a aplicação web consiga se conectar na API via PHP.
```dosini
APP_URL=http://192.168.53.6/
API_URL=http://192.168.53.6:9999/api/v1/
```


Acessar a interface web:
[http://localhost:8989](http://localhost:8989)
Acessar a API:
[http://localhost:9999](http://localhost:9999)
