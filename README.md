<h5 align="center">
  <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/3/31/Webysther_20160423_-_Elephpant.svg/1280px-Webysther_20160423_-_Elephpant.svg.png" width="200" /><br>
  <b>PHP API structure</b> 🐘
</h5>
<p align="center">
  <img alt="License" src="https://img.shields.io/badge/license-MIT-brightgreen">
  <img alt="CI Badge" src="https://github.com/pferreirafabricio/php-templateApi/actions/workflows/php.yml/badge.svg">
</p>

## :open_book: About 
This project is a simple PHP API structure for use in quick and small projects without frameworks.
<br /><br />

## :bricks: This project was built with: 
- [PHP](https://www.php.net/)
- [CoffeCode Router](https://github.com/robsonvleite/router)
- [MySQL](https://www.mysql.com/)
- [Nginx](https://www.nginx.com/)
- [Docker](https://www.docker.com/)

## :running_man: Installing and Running  
 1. Clone this repository `git clone https://github.com/pferreirafabricio/php-templateApi.git`
 2. Enter in the project's folder: `cd php-templateApi`
 3. Copy the .env.example file to .env: `cp .env.example .env`
 4. Change the .env file with your configurations
 5. Build the app image: `docker compose build app`
 6. Start the containers: `docker compose up -d`
 7. Install project's dependencies: `docker compose exec app composer update`
 8. Finally you can visit [`127.0.0.1:8000/`](http://127.0.0.1:8000/) from your browser 😃
 
## :recycle: Contribute
 1. Fork this repository;
 2. Create a branch with your feature: ```git checkout -b my-feature```
 3. Commit your changes: ```git commit -m 'feat: My new feature'```
 4. Push your branch: ```git push origin my-feature```
 
## :page_with_curl:	License
This project is under the MIT license. Take a look at the [LICENSE](LICENSE) file for more details.
