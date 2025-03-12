// src/api.js
import axios from 'axios';

// Crea una instancia de axios configurada para el API Gateway
const api = axios.create({
  baseURL: 'http://api-gateway.docker.localhost/api', // URL del API Gateway
});

// Interceptor para agregar el token JWT a cada solicitud, si está almacenado
api.interceptors.request.use(config => {
  const token = localStorage.getItem('token');
  if (token) {
    config.headers.Authorization = `Bearer ${token}`;
  }
  return config;
}, error => Promise.reject(error));

export default api;
