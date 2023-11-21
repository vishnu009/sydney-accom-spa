<template>
  <div id="app">
    <div class="header">
      <img src="./assets/header.jpg" alt="Header Image">
      <h1>Welcome to Sydney, please use below filters to search Accommodation in Sydney </h1>
    
    </div>
    <div class="content">
      <product-filter></product-filter>
    </div>
  </div>
</template>

<script>
import ProductFilter from './components/ProductFilter.vue'

export default {
  name: 'App',
  components: {
    ProductFilter
  }
}
</script>

<style scoped>
.header {
  width: 100%;
  text-align: center;
}

.header img {
  max-width: 100%;
  height: 500px;
}

.content {
  display: flex;
  justify-content: center;
}
</style>
