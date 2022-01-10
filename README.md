

## Install


- git clone
- composer install
- cp .env.example .env (+update config variables)
- php artisan key:generate
- php artisan doctrine:migrations:migrate


## Usage

### Users

- GET api/users  - get all users
- GET api/users/{id} - get user
- POST api/users - create user
  
  {

    "name": "name",

  "email": "xxx@xxx.xx",

  "password": "xxx"

  }

- PUT api/users/{id} - update user

    {

        "name" : "xxx",

        "email": "xxx@xxx.xx",

        "password": "xxx"

    }
- DELETE api/users/{id}

### Profile

- GET api/users/profile/{user_id}  - get user's profile
- POST api/users/profile/{user_id} - create user's profile

  {

  "firstName": "first name",

  "lastName": "last name",

  "birthday": "YYYY-mm-dd"

  }

- PUT api/users/profile/{user_id} - update user's profile

  {

        "firstName": "first name",
        "lastName": "last name",
        "birthday": "YYYY-mm-dd"
  }

### Roles

- GET api/roles - get all roles
- POST api/roles - create role

     {

        "name" : "xxx",

     }
- PUT api/roles/{role_id} - update role

    {

        "name" : "xxx",

     }

- PUT api/roles//{role_id}/user/{user_id} - add role to user
        
