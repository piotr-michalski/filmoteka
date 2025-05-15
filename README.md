# **movies-service**
## **Stack**
#### **Symfony 6.4 LTS**
#### **PHP 8.4 **
## **Development**
### **Running the Application**
#### **Start Containers**
- In interactive mode (logs visible in the console):
  ```sh
  docker compose up --build
  ```  
- In detached mode (running in the background):
  ```sh
  docker compose up --build -d
  ```
#### **Stop Containers**
```sh
docker compose down
docker compose down -v
```
#### **Remove Docker Volumes**
```sh
docker volume rm <volume_name>
```
---
## **API Documentation**
- API documentation is available at:
  [http://localhost:8080/api/doc](http://localhost:8080/api/doc)
---
## **Testing**
Symfony PHPUnit Bridge:
- Place test cases in the `tests/` folder.
- Generate tests using:
  ```sh
  php bin/console make:test
  ```  
- Run tests:
  ```sh
  bin/phpunit
  ```  
- Run tests inside the Docker container:
  ```sh
  docker compose exec <container_name> php bin/phpunit
  ```