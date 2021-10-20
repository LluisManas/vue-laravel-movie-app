<template>
  <div>
    <findmovie ></findmovie>
    <popularmovies></popularmovies>
    <topratedmovies></topratedmovies>
  </div>
</template>

<script>
import popularmovies from "./PopularMoviesComponent.vue";
import topratedmovies from "./TopRatedMoviesComponent.vue";
import findmovie from './FindMovieComponent.vue';
import { mapGetters } from 'vuex';
import countrypopup from '../popups/CountryPopUpComponent.vue';

export default {
  name: "movies",
  created() {
    this.$store.dispatch('updateUserData')
  },
  computed: {
    ...mapGetters(['getCountry'])
  },
  components: {
    countrypopup,
    findmovie,
    popularmovies,
    topratedmovies
  },
};
</script>

<style scoped>
</style>