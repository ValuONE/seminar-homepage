
# The website for my school project

This is a fully functional blog written in PHP. The whole project is base on the mvc pattern and is also object oriented.

Small reminder i am very bad in front-end design, so please dont judge me :/
## Features

- User Login
- Add/Edit/Delete Posts
- OOP-Based
- Vote-System for Pictures

## Deployment

To deploy this project you need to copy the repository

```bash
  git clone https://github.com/ValuONE/seminar-homepage.git
```

Set up your database-server (MySQL or MariaDB) and create the database and tables with the [databse.sql](https://github.com/ValuONE/seminar-homepage/blob/master/database.sql) file

```sql
CREATE TABLE `blog` (
                        `bid` int(255) NOT NULL,
                        `title` varchar(255) DEFAULT NULL,
                        `content` varchar(5000) DEFAULT NULL,
                        `author` varchar(255) DEFAULT NULL,
                        `created_at` varchar(255) DEFAULT NULL,
                        `filename` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
  
  etc...
```

Edit the [db-connnect.inc.php](https://github.com/ValuONE/seminar-homepage/tree/master/inc/db-connect.inc.php) file to match your credentials

After setting up the webserver you can now just enter the [index.php](https://github.com/ValuONE/seminar-homepage/tree/master/index.php) file with a route parameter like index.php?route=home and the website is set up!
## Author

- [valu](https://github.com/ValuONE)

