# To-do-task-App
Simple To-do Web app with php and MySQL


## Technologies Used
1. Core PHP Programming Language
2. MySQL Database
3. HTML
4. CSS


#How to run it

1. Download and Install XAMPP

[Click Here to Download](https://www.apachefriends.org/index.html)

2. Install any Text Editor

### Installation

1. Download as a Zip or Clone this project
2. Move this project to Root Directory
```
Local Disc C: -> xampp -> htdocs -> 'this project'
```
*Local Disk C is the location where xampp was installed*

3. Open XAMPP Control Panel and Start 'Apache' and 'MySQL'

4. Import Database

a. Open 'phpmyadmin' in your browser
b. Create a Database
c. Import the SQL file provided with this project

5. Make Changes to settings

Open the constants.php file and make these changes

```php
<?php
// start session
session_start();
// create constants
define('LOCALHOST', 'localhost');
define('DB_USERNAME', 'root'); //Your Database username instead of 'root'
define('DB_PASSWORD', ""); //Your Database Password (keep empty is password is null)
define('DB_NAME', 'task_manager'); //Your Database Name if it's not 'task_manager'
define('SITEURL', 'http://localhost/task-manager/'); //Update the home URL of the project if you have changed port number or it's live on server
?>
```

6.Now open the project in your browser using your SiteURL  
                      🐱‍💻🐱‍💻🐱‍💻🐱‍💻🐱‍💻
                      
## Follow Me
1. LinkedIn - [pruthvirajdhongade](https://www.linkedin.com/in/pruthviraj-dhongade-79468621b/)
2. Instagram - [@Pruthviraj_D](https://www.instagram.com/pruthviraj_dhongade)
3. Twitter - [@dhongade_raj](https://twitter.com/dhongade_raj)
