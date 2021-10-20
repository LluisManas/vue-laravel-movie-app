<template>
    <div class="container">
        <form @submit.prevent="findMovie('movie')" class="form-group">
            <div class="input-group">
                <input type="text" name="movie" id="movieSearch" v-model="searchMovie" placeholder="Search any movie..." class="form-control">
                <div class="input-group-append">
                    <button class="btn btn-secondary">
                        Search
                    </button>
                </div>
            </div>
        </form>
        <div v-if="getMoviesFound">
            <div class="container-fluid">
                <div class="d-flex flex-row flex-nowrap overflow-auto">
                    <div v-for="movie in getMoviesFound" :key="movie.id">
                        <moviecart :movie="movie"></moviecart>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters } from 'vuex';
import moviecart from './MovieCartComponent.vue';

export default {
    name: 'findMovie',
    data() {
        return {
            searchMovie: ''
        }
    },
    methods: {
        findMovie() {
            const movie = this.searchMovie;
            this.$store.dispatch('findMovies', movie);
            this.searchMovie = '';
        }
    },
    computed: {
        ...mapGetters(['getMoviesFound'])
    },
    components: {
        moviecart
    }
    
}
</script>
