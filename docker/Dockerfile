FROM php
ENV APP_DIR /var/www/app
ENV APPLICATION_ENV development
RUN mkdir -p $APP_DIR
WORKDIR $APP_DIR
EXPOSE 8080
VOLUME $APP_DIR
CMD ["php", "-S", "0.0.0.0:8080", "-t", "./public", "./public/built-in.php"]
