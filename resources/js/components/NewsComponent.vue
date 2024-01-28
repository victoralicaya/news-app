<template>
    <div class="container">
        <div class="container">
            <div class="mb-3">
                <input v-model="search" @input="fetchData" placeholder="Search..." class="form-control my-3">
                <button class="btn btn-submit btn-primary" @click="fetchData">Search</button>
            </div>

            <div v-for="(sectionArticles, section) in articles" :key="section" class="mb-4">
              <h2 class="mb-3">{{ section }}</h2>
              <div v-for="article in sectionArticles" :key="article.url" class="card mb-2">
                <div class="card-body">
                  <h3 class="card-title">{{ article.title }}</h3>
                  <a :href="article.url" class="card-link">{{ article.url }}</a>
                  <p class="card-text">{{ article.date }}</p>
                </div>
              </div>
            </div>
          </div>
    </div>
</template>

<script setup>
    import { ref } from 'vue';
    import axios from 'axios';

    const search = ref('');
    const articles = ref([]);

    const fetchData = () => {
    axios.get('/api/search', { params: { search: search.value } })
        .then(response => {
            articles.value = response.data;
        });
    };
</script>
