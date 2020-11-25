
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
--  ( use sudo if needed) docker exec -it doctor_appointment_web bash

--  cd app

--  php composer install

--  php artisan migrate:fresh

--  php artisan db:seed

--  exit

--  Edit /etc/hosts file

--  addLine-> 127.0.0.1 local.doctor_appointment.com


--  Ready to go

--  Visit local.doctor_appointment.com on your browser

--  Admin Credentials: Admin_Dap@gmail.com - Admin_Dap

--  User1 Credentials: User1_Dap@gmail.com - User1_Dap

--  User2 Credentials: User2_Dap@gmail.com - User2_Dap

