<template>
  <div>
    <v-text-field v-model="location" label="Search..." clas="mt-2" filled prepend-inner-icon="mdi-magnify" 
                dense solo flat background-color="grey lighten-4" rounded></v-text-field>
  </div>

  <div>
    Ward
    <v-text-field v-model="ward"></v-text-field>
  </div>

    <div>
    Sub-County
    <v-text-field v-model="subcounty"></v-text-field>
  </div>

  <div>
    County
    <v-text-field v-model="county"></v-text-field>
  </div>
</template>

<style scoped>
h1 {
  font-weight: 500;
  font-size: 2.6rem;
  position: relative;
  top: -10px;
}

h3 {
  font-size: 1.2rem;
}

.greetings h1,
.greetings h3 {
  text-align: center;
}

@media (min-width: 1024px) {
  .greetings h1,
  .greetings h3 {
    text-align: left;
  }
}
</style>

<script setup>
defineProps({
  msg: {
    type: String,
    required: true
  }
})
</script>
