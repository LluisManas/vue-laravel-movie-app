import axios from "axios";

const state = {
    userName: "",
    country: "",
    countriesList: {}
};

const mutations = {
    UPDATE_USERNAME(state, payload) {
        state.userName = payload;
    },
    GET_COUNTRIES_LIST(state, payload) {
        state.countriesList = payload;
    },
    UPDATE_COUNTRY(state, payload) {
        state.country = payload;
    }
};

const actions = {
    updateUserData({ commit }) {
        axios.get("/api/user").then(response => {
            commit("UPDATE_USERNAME", response.data.name);
            commit("UPDATE_COUNTRY", response.data.country);
        });
    },
    getCountriesList({ commit }) {
        axios.get("/api/countries-list").then(response => {
            commit("GET_COUNTRIES_LIST", response.data.list);
        });
    },
    updateCountry({ commit }, country) {
        axios
            .post("/api/update-country", country)
            .then(response => {
                console.log("country", response.data.country);
                commit("UPDATE_COUNTRY", response.data.country);
            })
            .catch(err => {
                console.log(err);
            });
    }
};

const getters = {
    getUserName: state => state.userName,
    getCountry: state => state.country,
    getCountriesList: state => state.countriesList
};

const userStore = {
    state,
    mutations,
    actions,
    getters
};

export default userStore;
