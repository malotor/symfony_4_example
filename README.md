# Twitter API

## Install composer

Create new composer file
       
        $ sudo vim /usr/local/bin/composer
        
The contents of the file will look like this
 
        #!/bin/sh
        export PATH=/sbin:/bin:/usr/sbin:/usr/bin:/usr/local/sbin:/usr/local/bin
        echo "Current working directory: '"$(pwd)"'"
        docker run --rm -v $(pwd):/app -v ~/.ssh:/root/.ssh composer $@

Once the script has been made, it must be set as executable

        $ sudo chmod +x /usr/local/bin/composer
Now the composer command is available native on host:

        $ composer --version


## Run the project

      $ composer install
      
      $ docker-compose up -d
      $ docker-compose exec app php bin/console cache:clear
      $ docker-compose exec app bin/phpunit


## Access the API

      $ http://10.42.0.42:8080/tweets/mloptor/10
