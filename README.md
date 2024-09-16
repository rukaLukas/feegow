# Feegow Web Application

## Contexto

Este projeto é uma aplicação web com frontend Vue.js(v3) com framework Vuetify(v3) e backend Laravel(10), ambos Dockerizados. O aplicativo usa MySQL como banco de dados e Redis para armazenamento em cache e gerenciamento de filas.

## Estrutura projeto

- `root directory`
  - `api/` - Laravel backend code.
  - `front/` - Vue.js frontend code.
  - `mysql/` - Mount volume MySQL database data.
  - `redis/` - Mount volume Redis data.
  - `nginx/` - Arquivos configuração Nginx.
  - `docker-compose.yml` - Arquivo de configuração Docker Compose.
  - `README.md` - This file.

## Pré-requisitos

- Docker
- Docker Compose

## Setup

1. **Clone Repositório:**

   ```bash
   git clone https://github.com/rukaLukas/feegow
   cd ./feegow
   ```

2. **Build e Inicialização dos serviços:**

    ```bash
    docker compose up --build
    ```

3. **Acesse aplicação:**

    Front-end estará disponível na porta 8080 - http://localhost:8080
    Api estará disponível na porta 8181 - http://localhost:8181