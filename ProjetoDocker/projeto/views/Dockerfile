# Escolhe uma imagem base oficial do PHP com Apache
FROM php:8.2-apache

# Instala extensões adicionais do PHP (se necessário)
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copia o código-fonte para o diretório raiz do Apache
COPY ./home.php /var/www/html/

# Expõe a porta 80
EXPOSE 80