<template>
    <div id="app">
      <select v-model="selectedRegion">
        <option v-for="region in regions" :key="region" :value="region">
          {{ region }}
        </option>
      </select>
      <select v-model="selectedCity">
        <option v-for="city in cities" :key="city" :value="city">
          {{ city }}
        </option>
      </select>
      <div v-for="product in filteredList" :key="product.product_id">
        <h2>{{ product.product_name }}</h2>
        <p>{{ product.product_description }}</p>
      </div>
    </div>
  </template>
  
  <script>
  import { ref, computed } from 'vue'
  import axios from 'axios'
  
  export default {
    name: 'ProductFilter',
    setup() {
      const selectedRegion = ref('')
      const selectedCity = ref('')
      const products = ref([])
  
      axios.get('http://localhost:8000/')
        .then(response => {
          products.value = response.data.products.product_record
        })
        .catch(error => {
          console.error(error)
        })
  
      const regions = computed(() => {
        const allRegions = products.value.map(product => product.addresses.address.region)
        return [...new Set(allRegions)]
      })
  
      const cities = computed(() => {
        const allCities = products.value.map(product => product.addresses.address.city)
        return [...new Set(allCities)]
      })
  
      const filteredList = computed(() => {
        return products.value.filter(product => {
          return product.addresses.address.region === selectedRegion.value && 
                 product.addresses.address.city === selectedCity.value
        })
      })
  
      return {
        selectedRegion,
        selectedCity,
        regions,
        cities,
        filteredList
      }
    }
  }
  </script>
  