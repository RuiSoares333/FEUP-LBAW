# lbaw2286

# 1 - Collaborative News
The Super Legit Collaborative News (SLCN) is a project headed by a small group of developers with the main goal of free, open and accessible news sharing for and by users. 

This will allow all users to view and browse the top and most recent news and comments on any topic, with access to text search and tag filtering.

# Project Components
- [ER: Requirements Specifications](docs/er.md)
- [EBD: Database Specification Component](docs/ebd.md)
- [EAP: Architecture Specification and Prototype](docs/eap.md)
- [PA: Product and Presentation](https://git.fe.up.pt/lbaw/lbaw2223/lbaw2286/-/wikis/home)

# Artifacts Checklist
- The artifacts checklist is available at: <https://docs.google.com/spreadsheets/d/1u9VdbDK9cWcKivwyWI79DzTGCuPImm2Ktg8aw6YHFF0/edit#gid=1497188515>

### Usage

http://lbaw2286.lbaw.fe.up.pt

Install:
```
composer install
composer require pusher/pusher-php-server
php artisan route:clear &&   php artisan view:clear &&  php artisan config:clear && php artisan cache:clear &&  php artisan clear-compiled
```

And to run it locally:
```
docker run -it -p 8000:80 --name=lbaw2286 -e DB_DATABASE="lbaw2286" -e DB_SCHEMA="lbaw2286" -e DB_USERNAME="lbaw2286" -e DB_PASSWORD="HfwKxxtO" git.fe.up.pt:5050/lbaw/lbaw2223/lbaw2286
```



### Administration Credentials

| Email | Password |
| -------- | -------- |
| admin@example.com  | 1234 |
| lucas@legitmail.com | legitlucas | 


### User Credentials

| Type          | Email  | Password |
| ------------- | --------- | -------- |
| basic account | andre@legitmail.com | legitandre |


# Team
- André Morais, up202005303@edu.fe.up.pt
- João Teixeira, up202005437@edu.fe.up.pt
- Lucas Sousa, up202004682@edu.fe.up.pt
- Rui Soares, up202103631@edu.fe.up.pt

#### lbaw2223-t8g6, 22/09/22
