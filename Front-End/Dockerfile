FROM php:8.2-apache

# Instalar extensão PDO MySQL
RUN docker-php-ext-install pdo pdo_mysql

# Habilitar mod_rewrite (importante para rotas REST)
RUN a2enmod rewrite

# Copiar código para dentro do container
COPY . /var/www/html/

# Definir diretório de trabalho
WORKDIR /var/www/html

EXPOSE 80
