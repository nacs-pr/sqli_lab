# Use the official PHP image as our base
FROM php:7.4-apache

# Install the mysqli extension
RUN docker-php-ext-install mysqli