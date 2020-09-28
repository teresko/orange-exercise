
deploy: ; composer install ; docker build -f docker/Dockerfile -t daedalus . ; docker run -d -v $(CURDIR):/var/www/app -p 8080:8080 --name wintermute daedalus

stop: ; docker stop wintermute ; docker rm wintermute

test: ; ./vendor/bin/phpunit --configuration tests/unit/phpunit.xml.dist tests/unit
