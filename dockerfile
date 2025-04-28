FROM php:8.2-apache

# PostgreSQL için gerekli sistem paketlerini yükleyin
RUN apt-get update && apt-get install -y \
    libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql \
    && rm -rf /var/lib/apt/lists/*  # Gereksiz dosyaları temizleyin

# Apache modülünü etkinleştir
RUN a2enmod rewrite

# PHP dosyalarını Apache dizinine kopyala
COPY . /var/www/html/

# Apache servisinin başlatılması
CMD ["apache2-foreground"]

# Çalıştırılacak portu belirle
EXPOSE 8081
