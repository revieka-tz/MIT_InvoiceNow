**Install Supporting Software - For Windows OS**
1. nginx
    1) Download from https://nginx.org/en/download.html -> nginx/Windows-1.26.2
    2) Extract the downloaded ZIP file to a directory, for example, C:\nginx
    3) Open the application "nginx.exe", then open http://localhost or http://127.0.0.1 on the browser.
       If the installation was successful, the page will looks like this
       ![image](https://github.com/user-attachments/assets/aa498611-e809-4d26-851d-9d8ded37e9ce)
    4) To make the nginx accessible from command prompt go to _Edit system environtment variable_ -> _System (Path)_ -> _New Environtment "C:\nginx"_
       ![image](https://github.com/user-attachments/assets/320b4e6d-e42c-45af-be22-25f15fe8ee3c)
       ![image](https://github.com/user-attachments/assets/7fe487ab-95da-4190-a658-900c48e3462c)
       ![image](https://github.com/user-attachments/assets/466e3f35-4073-4f49-84b5-f273952eb11b)
    5) Test 




3. PHP 8.3.12
4. Node.js 20.17.0
5. Composer

**Middleware App Setup**
1. Place Your Laravel Project in a Suitable Directory
   You need to put your Laravel project in a folder that Nginx can serve.
   1) Choose a directory to store your Laravel projects. You can place it anywhere, for example, _C:\nginx\www\mit_invoicenow_.
   2) Move/Copy your Laravel project to this directory.
   3) Make sure the public folder inside your Laravel project will be the directory Nginx serves (this is where the index.php file is located).

2. Configure Nginx to Serve Laravel
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
   4) Ensure PHP is set up correctly (next step) so that Nginx can handle .php files.
      NOTE: Ensure there's only 1 nginx running. Check it from cmd prompt using _netstat -an | findstr :80_
      ![image](https://github.com/user-attachments/assets/57d5385b-0100-48e5-88e1-01a6d1a1d08f)
      If more than 1, force Stop nginx using cmd prompt _taskkill /F /IM nginx.exe_ then run the **nginx.exe** again
