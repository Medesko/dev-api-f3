## API CINE DEV
###1 Structure

```
├── api
│   ├── controllers
│   │   ├── fb_controller.php
│   │   └── Users.php
│   ├── configs
│   │   ├── routes.ini
│   │   └── config.ini
│   ├── components
│   │   ├── src
│   │   │   ├── fb_ca_chain_bundle.crt
│   │   │   ├── facebook.php
│   │   │   └── base_facebook.php
│   │   ├── orm
│   │   │   ├── orm.php
│   │   │   └── models
│   │   │       └── ORMUsers.php
│   │   ├── api.php
│   │   └── Fb.php
│   └── api.php
├── framework
│   ├── api
│   ├── db
│   │   ├── jig
│   │   ├── mongo
│   │   └── sql
│   └── web
│       └── google

```
###2. Get Facebook token
```
http://localhost/dev-api-f3/users/login
```

###3. Get All Users Admin token
```
http://localhost/dev-api-f3/users/?token_access=5460db491a656bb98da693f8e090f5fa
```
###4. Get User by id and Token
```
http://localhost/dev-api-f3/users/15?token_access=3b8aff744e0d7d402cef967eedfff1c1
```

###5. POST User 
```
http://localhost/dev-api-f3/users/insert_user 
```
###6. DELETE User 
```
DELETE /users/@id = Users->deleteUser
```
###7. Get All Movies  
```
http://localhost/dev-api-f3/movies/list_movies
```

###8. Get Movie by id  
```
http://localhost/dev-api-f3/movies/1
```

###9. Insert id, title, details of  Movie
```
http://localhost/dev-api-f3/movies/insert_movie 
```

###10. DELETE Movie by id
```
http://localhost/dev-api-f3/movies/1 
```
