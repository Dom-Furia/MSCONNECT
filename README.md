# Projeto Fullstack com Docker (Angular + PHP + MySQL)

Este projeto utiliza Docker e Docker Compose para  um ambiente completo com:

- **Frontend**: Angular
- **Backend**: PHP 8
- **Banco de Dados**: MySQL 8

---

## 🚀 Como buildar e executar a aplicação

1. **Clone o repositório:**

```bash
git clone https://github.com/Dom-Furia/MSCONNECT.git
```

2. **Crie o arquivo .env na raiz do projeto**

3. **Edite o arquivo .env com suas credenciais e configurações:**
```bash 
DB_HOST=db
DB_PORT=3306
DB_DATABASE=meubanco
DB_USERNAME=usuario
DB_PASSWORD=senha
MYSQL_ROOT_PASSWORD=rootpass
```
4. **Faça instalação do docker em sua maquina:**

```bash
link: https://www.youtube.com/watch?v=XbXfWAze-I8
link: https://www.docker.com/
```

5. **Buildar e subir a aplicação com Docker Compose:**

```bash
docker-compose up --build

```
Esse comando irá:
- **Buildar as imagens do backend e frontend**
- **Criar os containers**
- **Subir o banco de dados com volume persistente**


🐳 Comandos Docker Compose úteis
Ação	                                    Comando
Subir a aplicação com build	                docker-compose up --build
Subir sem rebuild	                        docker-compose up
Parar os containers	                        docker-compose down
Limpar tudo (inclui volumes e imagens)	    docker-compose down --volumes --rmi all


🌐 URLs de acesso

Após os containers estarem rodando, acesse:

Serviço	            URL	                                           Porta
Frontend	        http://localhost:4200                           4200
Backend API         http://localhost:8080                           8080
MySQL               localhost:3306 (acesso via cliente MySQL)       3306








