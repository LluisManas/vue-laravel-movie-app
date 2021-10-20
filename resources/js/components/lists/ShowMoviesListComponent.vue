<template>
    <div class="container">
        <p>Movies in List</p>
        <div class="grid-container">
            <div v-for="movie in getMoviesFromList" :key="movie.id">
                <moviecart :movie="movie"></moviecart>
                <button class="btn btn-danger" @click="removeFromList(movie.id)">Remove from List</button>
            </div>
        </div>
    </div>
</template>

<script>
import {mapGetters} from 'vuex';
import moviecart from '../movies/MovieCartComponent.vue';

export default {
    name: 'showMoviesList',
    props: ['id'],
    created() {
        this.$store.dispatch('getMoviesFromList', this.id)
    },
    methods: {
        removeFromList(movieId) {
            const data = {
                'movieId': movieId,
                'listId': this.id
            };
            this.$store.dispatch('deleteMovieFromList', data);
        }
    },
    computed: {
        ...mapGetters(['getMoviesFromList', 'getMovieDetails'])
    },
    components: {
        moviecart
    }
}
</script>

<style scoped>
.grid-container {
    display: grid;
    grid-template-columns: auto auto auto auto;
    align-content: space-evenly;
}
</style>
