<template>
  <div>
    <router-view></router-view>
  </div>
</template>

<script>
import movies from "./movies/MoviesComponent.vue";
import list from './ListsComponent.vue';
import addmovietolist from './lists/AddMovieToListComponent.vue';
import userdetails from './user/UserDetailsComponent.vue';
import edituserdetails from './user/EditUserDetailsComponent.vue';

export default {
  name: "appcomponent",
  components: {
    movies,
    list,
    addmovietolist,
    userdetails,
    edituserdetails
  },
};
</script>
