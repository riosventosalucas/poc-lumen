# Etapa de construcción: se compila la aplicación
FROM node:16-alpine AS build-stage
WORKDIR /app
# Copia los archivos de configuración e instala las dependencias
COPY package*.json ./
RUN npm install
# Copia el resto del código fuente
COPY . .
# Construye la aplicación (la salida por defecto es en la carpeta "dist")
RUN npm run build

# Etapa de producción: se sirve la aplicación compilada con Nginx
FROM nginx:stable-alpine AS production-stage
# Copia los archivos compilados al directorio que Nginx usa para servir
COPY --from=build-stage /app/dist /usr/share/nginx/html

# Copia la configuración personalizada de Nginx
COPY nginx.conf /etc/nginx/conf.d/default.conf

EXPOSE 80
CMD ["nginx", "-g", "daemon off;"]
