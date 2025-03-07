Para crear usuario:


curl -X POST http://backend.docker.localhost/register \
     -H "Content-Type: application/json" \
     -d '{"name": "Juan Pérez", "email": "juan@example.com", "password": "123456"}'