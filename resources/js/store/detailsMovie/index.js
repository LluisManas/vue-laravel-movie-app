import axios from "axios";

const state = {
    movie: [],
    movies: []
};

const mutations = {
    GET_MOVIE_DETAILS(state, payload) {
        state.movie = payload;
    },
    UPDATE_MOVIES(state, payload) {
        state.movies = payload;
    }
};

const actions = {
    getMovieDetails({ commit }, id) {
        axios.get(`/api/movie/${id}`).then(response => {
            console.log("here", response.data);
            commit("GET_MOVIE_DETAILS", response.data);
        });
    },
    findMovies({ commit }, movie) {
        axios.get(`/api/search-movie/${movie}`).then(response => {
            console.log(response.data.results);
            commit("UPDATE_MOVIES", response.data.results);
        });
    }
};
const getters = {
    getMovieDetails: state => state.movie,
    getMoviesFound: state => state.movies
};

const movieStore = {
    state,
    mutations,
    actions,
    getters
};

export default movieStore;
