<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header">
                    <h2>Your details:</h2>
                </div>
                <div class="card-body">
                    <p><strong>Username:</strong> {{ getUserName }}</p>
                    <p><strong>Country:</strong> {{ getCountry }}</p>
                    <p><strong># Lists: {{ getMovieLists.length }}</strong></p>
                </div>
                <div class="card-footer">
                    <button class="btn btn-success">
                        <router-link :to="{path: '/edit-user-details'}">Change Steaming Country</router-link>
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters } from 'vuex';

export default {
    name: 'userdetails',
    created() {
        this.$store.dispatch('updateUserData');
        this.$store.dispatch('showLists');
    },
    computed: {
        ...mapGetters(['getUserName', 'getCountry', 'getMovieLists'])
    }
}
</script>
