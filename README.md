
Installation guide:

--  install docker (https://docs.docker.com/get-docker/)

    Terminal
--  ( use sudo if needed ) docker-compose up -d

    Database Setup
--  Workbench (or something similar) -> create Database
    -> port 33067
    -> Username : root
    -> Password : root
    
    Terminal
--  ( use sudo if needed) docker exec -it artion_web bash
--  cd app
--  php composer install
--  php artisan migrate:fresh
--  php artisan db:seed
--  exit

--  Edit /etc/hosts file
--  addLine-> 127.0.0.1 local.artian.com


--  Ready to go
--  Visit local.artian.com on your browser
