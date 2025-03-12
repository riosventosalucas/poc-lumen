<template>
  <div class="login-container">
    <div class="card mx-auto" style="width: 25rem;">
      <div class="card-header text-center">
        <h4>Login</h4>
      </div>
      <div class="card-body">
        <form @submit.prevent="login">
          <!-- Campo de email -->
          <div class="form-group">
            <label for="email">Email</label>
            <input
              v-model="email"
              type="email"
              class="form-control"
              id="email"
              placeholder="Introduce tu email"
              required
            />
          </div>

          <!-- Campo de password -->
          <div class="form-group">
            <label for="password">Password</label>
            <input
              v-model="password"
              type="password"
              class="form-control"
              id="password"
              placeholder="Introduce tu contraseña"
              required
            />
          </div>

          <!-- Si está cargando, muestra el spinner, de lo contrario muestra el botón de login -->
          <div v-if="isLoading" class="text-center">
            <div class="spinner-border text-primary mt-1" role="status">
              <span class="sr-only"></span>
            </div>
          </div>

          <button v-else type="submit" class="btn btn-primary btn-block">
            Ingresar
          </button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      email: '',
      password: '',
      isLoading: false, // Propiedad para controlar el estado de carga
    };
  },
  methods: {
    async login() {
      this.isLoading = true;  // Activamos el estado de carga

      try {
        const response = await axios.post('http://api-gateway.docker.localhost/api/login', {
          email: this.email,
          password: this.password,
        });

        // Si la respuesta es exitosa, guardamos el token y redirigimos
        if (response.data.token) {
          localStorage.setItem('token', response.data.token);
          this.$router.push({ name: 'ContactsView' });
        } else {
          alert('Credenciales inválidas');
        }
      } catch (error) {
        console.error('Error de login:', error);
        alert('Error de login, intenta nuevamente');
      } finally {
        this.isLoading = false;  // Terminamos el estado de carga, aunque haya un error o éxito
      }
    },
  },
};
</script>

<style scoped>
/* Centrar el formulario */
.login-container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
  background-color: #f4f4f4;
}
</style>
