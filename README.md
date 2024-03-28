# Desafio "Rick and Morty"pedia

## Descrição
O objetivo deste desafio é desenvolver uma aplicação web que consuma a API do Rick and Morty para exibir os personagens da série. <br>
A aplicação deve incluir uma tela de listagem de personagens e uma tela de detalhes para cada personagem.

## Como rodar o projeto

#### Localmente (sem Docker)

**Pré-requisitos**

- PHP 8 ou superior

**Comando para rodar o projeto**
``` bash
php -S localhost:8000 -t src
```
#### Docker (opcional)

**Pré-requisitos**
- Docker
- Docker Compose

**Comando para rodar o projeto**
``` bash
docker-compose up
```	
### Tecnologias utilizadas
- Backend: PHP 8 Vanilla (sem frameworks)
- Frontend: Tailwind CSS com DaisyUI
- Banco de dados: SQLite

Optei por utilizar o SQLite como banco de dados devido à sua simplicidade e à ausência de configurações adicionais. <br>
Para este desafio, atendeu perfeitamente às necessidades.

E para o servidor, utilizei o do próprio PHP, que é suficiente para rodar a aplicação, ja que é para fins de teste.

### Estrutura do projeto
```shell
src
├── controllers # Controladores da aplicação
├── core # Classes utilitárias da aplicação e configurações
├── models # Modelos da aplicação
├── views # Visualizações da aplicação
├── index.php # Arquivo principal da aplicação
```