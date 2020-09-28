# Orange Sky Exercise

## Setup

There are two option for launching the application:

- execute `php -S 127.0.0.1:8080 ./public/built-in.php` from terminal (will need PHP installed locally)
- execute `make deploy` to run in docker (will require docker service running)

The actual entry point for the API code is `/public/api.php` (which is what one would be set in the Nginx url.rewrite), but in the "launch-able" options it gets called via `built-in.php` file, that acts as "rewriter" for PHP's bundled server.

## Requirements

Design, develop & test full-stack web application.

Functional requirements :

- Calculator with 4 functions (add, sub, div, mul)
- Ability to store/retrieve 5 last calculation results 

Non-functional requirements :

- Frontend : XHTML/JS (any framework), CSS (Sass/Less)
- Backend : PHP (any framework)
- DB : any (sql/nosql)
- API : REST
- Unit tests : PHP (any framework)
- Build tool : frontend - any, backend - any/framework specific
- Container : Docker
- Source control : Git (GitHub)

Bonus points :

- Clean code approach used
- Design patterns applied
- S.O.L.I.D principles demonstrated
- PSR standards observed


Application should run as single Docker container with all dependencies configured & bundled together, exposed on `localhost:8080`.  
Application should support running under profiles : "dev" (default) for local environments, "prod" for production deployments.
