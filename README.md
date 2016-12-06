# OLX Users Api

## Requirements

* php >= 7.0.0
* composer

## Installation and base configuration

Clone the project

```
$ git clone https://bitbucket.org/maxiskell/olx-users
```

Install dependencies

```
$ composer update
```

Run the schema script to create the users table
_(remember to first configure your mysql credentials and database name at ./config/database.json)_

```
$ mysql -u{your_username} -p olx < database/schema.sql
```

For testing purposes, you can also seed the database

```
$ mysql -u{your_username} -p olx < database/seeder.sql
```

## Run the application

Unfortunately, due to the lack of time and docker not working properly on my machine,
I could not test a container-based environment, so, let's just recur to a plain old php server :)

```
$ php -S localhost:3000 -t public/
```

Have fun! :)

---

## About the implementation

I tried to took the most minimal and understandable approach possible. I know there's plenty of room for
improvements, like injecting the Request class dependency in the UsersController methods, or creating an
appropriate Response class instead of returning arrays. But, again, due to the lack of time I tried to
keep things simple and as understandable as possible, focusing on the core functionallity of the excercise
given and not on creating a big full-blown framework, with a migrations system, IoC Container, services,
repositories and things like that.

---

## Logging

All PHP errors and thrown exceptions are catched and properly logged in _logs/users.log_.

---

## Endpoints

### GET /users

Retrieve all users in the database.

Example: `{base_url}/users`

Response:

```
HTTP/1.1 200 OK
Connection: close
Content-Type: application/json

{
    "data": [
        {
            "address": "123 Fake Street", 
            "id": 1, 
            "name": "Marge Simpson", 
            "picture": null
        }, 
        {
            "address": "221B Baker Street", 
            "id": 2, 
            "name": "Arthur Doyle", 
            "picture": null
        }, 
        {
            "address": "431 Some Avenue", 
            "id": 3, 
            "name": "John Doe", 
            "picture": null
        }
    ], 
    "status": 200
}

```

### GET /users/{id}

Retrieve a specific user entity, corresponding with the given id

Example: `{base_url}/users/1`

Response:

```
HTTP/1.1 200 OK
Connection: close
Content-Type: application/json

{
    "data": {
        "address": "123 Fake Street", 
        "id": 1, 
        "name": "Marge Simpson", 
        "picture": null
    }, 
    "status": 200
}

```

Not found response:

```
HTTP/1.1 404 Not Found
Connection: close
Content-Type: application/json

{
    "errors": "404 - Resource Not Found", 
    "status": 404
}
```

### POST /users

Create a new user entity.

Parameter | Description | Optional
--- | --- | ---
name | _The name of the new user_ | NO
address | _The address of the new user_ | YES

Example: `{base_url}/users {"name":"Jonathan Richman", "address":"345 Some Fancy Street"}`

Response:

```
HTTP/1.1 201 Created
Connection: close
Content-Type: application/json

{
    "data": {
        "address": "345 Some Fancy Street", 
        "id": 411, 
        "name": "Jonathan Richman"
    }, 
    "status": 201
}
```

Validation error response (example):

```
HTTP/1.1 400 Bad Request
Connection: close
Content-Type: application/json

{
    "errors": {
        "name": {
            "required": true
        }
    }, 
    "status": 400
}
```

### PATCH /users/{id}

Update a user entity data.

Parameter | Description | Optional
--- | --- | ---
name | _The name of the new user_ | YES
address | _The address of the new user_ | YES

Example: `{base_url}/users/1 {"name":"Fred Flinstone"}`

Response:

```
HTTP/1.1 200 OK
Connection: close
Content-Type: application/json

{
    "data": {
        "address": "123 Fake Street", 
        "id": 1, 
        "name": "Fred Flinstone", 
        "picture": null
    }, 
    "status": 200
}
```

Validation error response (example):

```
HTTP/1.1 400 Bad Request
Connection: close
Content-Type: application/json

{
    "errors": {
        "name": {
            "max_length": 100
        }
    }, 
    "status": 400
}
```

### DELETE /users/{id}

Remove a user entity.

Example: `{base_url}/users/1`

Response:

```
HTTP/1.1 200 OK
Connection: close
Content-Type: application/json

{
    "data": "The user has been successfully deleted", 
    "status": 200
}
```

Error response:

```
HTTP/1.1 404 Not Found
Connection: close
Content-Type: application/json

{
    "errors": "404 - Resource Not Found", 
    "status": 404
}
```

### POST /users/{id}/picture

Upload and set a user's prifile picture.

Example: `{base_url}/users/1/picture`

Parameter | Description | Optional
--- | --- | ---
filepath | _Full local path for the uploaded images_ | NO

Response:

```
HTTP/1.1 200 OK
Connection: close
Content-Type: application/json

{
    "data": "The user has been successfully deleted", 
    "status": 200
}
```

Validation error response:

```
HTTP/1.1 400 Bad Request
Connection: close
Content-Type: application/json

{
    "errors": "Invalid image file", 
    "status": 400
}
```

## General error responses

### Internal server error

```
HTTP/1.1 500 Internal Server Error
Connection: close
Content-Type: application/json

{
    "errors": "500 - Internal Server Error", 
    "status": 500
}

```

### Method not allowed

```
HTTP/1.1 405 Method Not Allowed
Connection: close
Content-Type: application/json

{
    "errors": "405 - Method Not Allowed", 
    "status": 405
}
```

### Route not found

```
HTTP/1.1 404 Not Found
Connection: close
Content-Type: application/json

{
    "errors": "404 - Not Found", 
    "status": 404
}
```

### User not found

```
HTTP/1.1 404 Not Found
Connection: close
Content-Type: application/json

{
    "errors": "404 - Resource Not Found", 
    "status": 404
}
```
