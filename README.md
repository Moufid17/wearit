### [Setting up the project](https://symfony.com/doc/current/setup.html#setting-up-an-existing-symfony-project) <sup >[1](#f1)</sup>

#### 1. Clone the project to download its contents
```
cd projects_directory/
git clone <project_link_in remote>
```
#### 2. Download the project lite database in __'../wearit/DB.waerit.sql'__  

#### 3. make Composer install the project's dependencies into vendor/

```
cd my-project_clone/
composer install
```

#### 4. MYSQL ISSUE (*version >= 7.4*):<sup id="a1"></sup>
  - _Install xampp_:
    - [Download runner](https://www.apachefriends.org/fr/download.html)
    - launch it with : 
        ```
        cd Download/
        ./xampp-linux-x64-8.1.2-0-installer.run
        ```
  - Start xampp : <sup id='a2'>[2](#f2)</sup>
    ``` 
    cd /opt/lampp/
    sudo ./manager-linux-x64.run
    ``` 
  - Php had been install : `php -v `
  - Php mysql driver : `php -i | grep mysql`
    - Not found ? : `sudo apt-get install php7.4-mysql`
  




#### Notes :

><b id="f1">1.</b>
    You'll probably also need to customize your .env file and do a few other project-specific tasks (e.g. creating a database). [↩](#a1)

><b id='f2'>2.</b>
    After run xampp and download the project database, import it in your *phpMyAdmin*. 
    It Locate at : _/opt/lampp/var/mysql/_[↩](#a2)

