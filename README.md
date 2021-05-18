# Users list
REST API for issuing a list of users from an external service via API

## Installation

Step-by-step instructions for starting a project:

**Run docker-compose:**
```bash
docker-compose up
```

**Create `.env` and generate app key:**
```bash
docker exec -it app cp .env.example .env
docker exec -it app php artisan key:generate
```

**Make database migration:**
```bash
docker exec -it app php artisan config:clear
docker exec -it app php artisan migrate
```

**Get vk token and insert into `.env` file:**

Find out your vk id via [this service](https://regvk.com/id/).
Copy and paste vk id into `VK_USER_ID`

Get your vk token via [this link](https://oauth.vk.com/authorize?client_id=7837252&scope=2&redirect_uri=https://oauth.vk.com/blank.html&display=page&response_type=token&revoke=1).
Copy vk token from url and paste into `VK_ACCESS_TOKEN`

**Run vk import console command:**
```bash
docker exec -it app php artisan config:clear
docker exec -it app php artisan vk:import
```

**API Routes:**
```bash
http://127.0.0.1:8000/api/users - list of all users
http://127.0.0.1:8000/api/user/34 - obtaining detailed information about a user by ID
```

## License

This project is licensed under the MIT License
