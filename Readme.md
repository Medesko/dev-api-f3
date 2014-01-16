# API CINE
###1 Structure

```
.
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
###2. Facebook
```
GET /users/login = Users->fbConnect
```

###3. Get All Users 
```
http://localhost/dev-api-f3/users/list_user
```
###4. Get User 
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
