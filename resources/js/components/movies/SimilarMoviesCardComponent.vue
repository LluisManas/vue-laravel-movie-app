<template>
    <div>
        <div @click="update_movie(movie)" class="card">
            <div class="card-body movie-card">
            <img :src="getImage(movie)" class="movie-image">
                <h5 class="card-title">{{ movie.original_title }}</h5>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'similarMoviesCard',
    props: ['movie'],
    methods: {
      getImage(movie) {
          const image = "https://image.tmdb.org/t/p/w500" + movie.backdrop_path;
          return image;
      },
      update_movie(movie) {
          this.$store.dispatch('getMovieDetails', movie.id)
      }
  }
}
</script>

<style scoped>
.movie-card {
    width: 13rem;
    height: 12rem;
}
.movie-image {
    width: 11rem;
    height: 8rem;
}
</style>