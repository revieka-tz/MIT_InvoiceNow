# Table of Contents
## - [A. Install Supporting Software - For Windows OS]
### - [1. Nginx](#1-nginx)
- [2. PHP](#2-php)
### - [3. Node.js 20.17.0]
4. B. Middleware App Setup


# **A. Install Supporting Software - For Windows OS**
## 1. Nginx
1) Download from https://nginx.org/en/download.html -> nginx/Windows-1.26.2
2) Extract the downloaded ZIP file to a directory, for example, C:\nginx
3) Open the application "nginx.exe", then open http://localhost or http://127.0.0.1 on the browser.
   If the installation was successful, the page will looks like this

   ![image](https://github.com/user-attachments/assets/aa498611-e809-4d26-851d-9d8ded37e9ce)
   
5) Make the nginx accessible from CLI, go to
   _Edit system environtment variable_ -> _System (Path)_ -> _New Environtment "C:\nginx"_
   
   ![image](https://github.com/user-attachments/assets/320b4e6d-e42c-45af-be22-25f15fe8ee3c)
   ![image](https://github.com/user-attachments/assets/7fe487ab-95da-4190-a658-900c48e3462c)
   ![image](https://github.com/user-attachments/assets/466e3f35-4073-4f49-84b5-f273952eb11b)

6) Check from the command prompt _"nginx -v"_ , the response should be

   ![image](https://github.com/user-attachments/assets/b9b50dad-3328-44fb-a215-b0492b41104f)


## 2. PHP
1) Download from https://windows.php.net/download/, v8.3.12 Thread Safe
2) Extract the downloaded ZIP file to a directory, for example, C:\php
3) Configure Environment Variables
   To run PHP from anywhere on the command line, you need to add PHP to the system’s PATH environment variable. (same as nginx intruction no. 5)
4) Check from the command prompt _"php -v"_ , the response should be

   ![image](https://github.com/user-attachments/assets/bdf8c9c7-5164-4ad7-a975-a5114ae2c0a0)

5) Configure php.ini
   - Go to the PHP folder (C:\php).
   - You will find a file named php.ini-development or php.ini-production. Copy one of them and rename it to php.ini.
   - Open php.ini in a text editor (like Notepad or VS Code).
   - Enable common PHP extensions by removing the ; before these lines:
     ```ini
     extension_dir = "ext"
     extension=curl
     extension=fileinfo
     extension=mbstring
     extension=openssl
     extension=mysqli
     extension=sqlite
 
## 3. Node.js 20.17.0


# **B. Middleware App Setup**
## 1. Place Your Laravel Project in a Suitable Directory
   You need to put your Laravel project in a folder that Nginx can serve.
   1) Choose a directory to store your Laravel projects. You can place it anywhere, for example, _C:\nginx\www\mit_invoicenow_.
   2) Move/Copy your Laravel project to this directory.
   3) Make sure the public folder inside your Laravel project will be the directory Nginx serves (this is where the index.php file is located).

## 2. Configure Nginx to Serve Laravel
   You need to configure a server block (virtual host) in Nginx to point to the public folder of your Laravel project.
   1) Open the Nginx configuration file:
      - The main configuration file is located at C:\nginx\conf\nginx.conf.
   2) Edit the Nginx configuration:
      - Open nginx.conf in a text editor (like Notepad or VS Code).
      - Add a new server block to point to your Laravel project's public folder.
         ```php
        # Server block for Laravel application
        server {
            listen       80;
            server_name  localhost;
    
            # Set the root to the 'public' directory of your Laravel project
            root   C:/nginx/www/mit_invoicenow/public;
            index  index.php index.html index.htm;
    
            # Ensure Laravel routes are handled properly
            location / {
                try_files $uri $uri/ /index.php?$query_string;
            }
    
            # Pass the PHP scripts to FastCGI server listening on 127.0.0.1:9000
            location ~ \.php$ {
                fastcgi_pass   127.0.0.1:9000;
                fastcgi_index  index.php;
                fastcgi_param  SCRIPT_FILENAME  $document_root$fastcgi_script_name;
                include        fastcgi_params;
            }
    
            # Deny access to .htaccess files
            location ~ /\.ht {
                deny all;
            }
    
            # Handle error pages
            error_page   500 502 503 504  /50x.html;
            location = /50x.html {
                root   html;
            }
        }
   3) Save the configuration file.
      NOTE: Ensure there's only 1 nginx running. Check it from cmd prompt using _netstat -an | findstr :80_
      ![image](https://github.com/user-attachments/assets/57d5385b-0100-48e5-88e1-01a6d1a1d08f)
      If more than 1, force Stop nginx using cmd prompt _taskkill /F /IM nginx.exe_ then run the **nginx.exe** again

## 3. Setup Existing Laravel Project
1) Navigate to Your Laravel Project Directory: Open Command Prompt and navigate to the directory where your Laravel project is located:
    ```bash
    cd C:/path/to/your/laravel-app
2) Install Dependencies: Run the following command to install all the necessary dependencies for your project:
    ```bash
    composer install
    
3) Set Up Your Environment File:
   - Copy .env.example to .env if you haven't already:
   - Open .env and configure the settings such as database, application name, and other environment variables.

4) Generate Application Key:
   - Run the following Artisan command to generate an application key:
     ```bash
     php artisan key:generate
     
5) Run Database Migrations (if applicable): If your project uses a database, run the migrations to set up the necessary tables:
   ```bash
   php artisan migrate

6) Start PHP-CGI (since Windows doesn’t use PHP-FPM like Linux):
   - Open Command Prompt and navigate to the PHP directory:
     ```bash
     cd C:\php
   - Start PHP as a FastCGI process:
     ```bash
     php-cgi -b 127.0.0.1:9000

## 4. Open the webpage
- Open this link on your browser http://localhost or http://127.0.0.1

![image](https://github.com/user-attachments/assets/b73f9555-50fc-4b5b-867e-db81ce171c4d)
