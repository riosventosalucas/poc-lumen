<template>
  <div class="contacts">
    <div class="container mt-5">
      <h2 class="text-center mb-4">Contactos</h2>
      <button @click="logout" class="btn btn-danger mb-3">Cerrar Sesión</button>

      <div v-if="contacts.length" class="list-group">
        <div
          v-for="contact in contacts"
          :key="contact.id"
          class="list-group-item d-flex justify-content-between align-items-center"
        >
          <div>
            <strong>{{ contact.name }}</strong><br />
            <small>{{ contact.email }}</small><br />
            <small>{{ contact.phone }}</small>
          </div>
        </div>
      </div>
      <p v-else class="text-center">No hay contactos.</p>
    </div>
  </div>
</template>

<script>
import api from '@/api';

export default {
  name: 'ContactsView',
  data() {
    return {
      contacts: [],
    };
  },
  async created() {
    try {
      const response = await api.get('/contacts');
      this.contacts = response.data;
    } catch (err) {
      console.error('Error al obtener contactos:', err);
    }
  },
  methods: {
    logout() {
      localStorage.removeItem('token');
      this.$router.push({ name: 'LoginView' });
    },
  },
};
</script>

<style scoped>
/* Estilos personalizados, si necesitas */
</style>
