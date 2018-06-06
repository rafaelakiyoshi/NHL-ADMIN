# Upfeat exercise: NHL Admin Interface


## What was used
### Front-End:
|Technology|Version|
|--------|---------|
|JavaScript|ES6|
|NPM|6.10|
|Node|8.11.2|
|Vue|2.9.5|
|vueX|3.0.1|
|vue router|3.0.1|
|Bootstrap|4.1|

### Back-End:
The Back-End was developed using Homestead by Laravel, and all the versions are in there. To develop the back-end was used:
  - Vagrant Version 2.1.0
  - VirtualBox Version 5.2.12
  - Lumen Micro-Framework
  - MySQL

## Folders
  On the root of the project, witch is the same folder as this file, you can find two principals folders: 
  - **NHL-ADM**: The Back-End Folder
  - **FRONT-END**: The Vue.js Code

  All the others folders and files are configuration for the homestead box to run the back-end.

## Running the project
  Since you have the Vagrant as well as virtualbox, and both in the minimum version above, type, at this folder, the following command to add homestead box:

  ```bash
  $ vagrant box add laravel/homestead
  ```
  Notice that there's a file at this folder named Homestead.yaml
  You have to make some chages. Open it up and update for your informations. **Dont forget to add the name in the /etc/hosts !**

  ```bash
  $ echo "192.168.10.10 nhl.admin" | sudo tee -a /etc/hosts
  ```

  After this, you can up your homestead vagrant box with the command:

  ```bash 
  $ vagrant up
  ```

And then, if everything works well, you can access the box typing:

  ```bash 
  $ vagrant ssh
  ```
  Now you can start to run the back-end. If you're having trouble, check out this tutorial: 
  [How to Install Homestead](https://threenine.co.uk/how-to-install-laravel-5-6-on-ubuntu-16-04/)

  #### Please run these commands inside the vagrant inside the 'code' folder, and in this same order:

  ```bash 
  $ php artisan migrate:reset
  ```

  ```bash 
  $ php artisan migrate
  ```

  Great. Now the MySQL has the tables. Now, run the following command to populate the DB with some seeds:

  ```bash 
  $ php artisan db:seed
  ```
### Please make sure that everything is working fine by running the tests:

  ```bash 
  $ phpunit
  ```

  Now we are ready to put the front-end up! Outside of vagrant ssh, go to the 'FRONT-END' folder and type:

  ```bash
  $ npm install
  ```

  And after that:
  ```bash
  $ npm run dev
  ```
## The application is up now! :)

Just to insure, I reccorded a simple video showing the application. You can see this video Here: https://www.youtube.com/watch?v=fTxODs5fSic&feature=youtu.be