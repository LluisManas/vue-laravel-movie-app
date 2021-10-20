<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="card">
                <div class="card-header">
                    <h2>Select your streaming country</h2>
                </div>
                <form @submit.prevent="updateCountry()">
                    <div class="card-body">                   
                        <div class="form-control">
                            <select class="selectpicker" id="countryList">
                                <option v-for="(value, name) in getCountriesList" :key="name" :value="name">
                                    {{ value }}
                                </option>
                            </select>
                        </div>               
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success center-text">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import { mapGetters } from 'vuex';
import router from '../../routes/index';

export default {
    name: 'edituserdetails',
    data() {
        return {
            value: ''
        }
    },
    created() {
        this.$store.dispatch('getCountriesList')
    },
    methods: {
        updateCountry() {
            const country = {
                'id': $('#countryList').children("option:selected").val(),
                'name': $('#countryList').children("option:selected").text()
            }
            this.$store.dispatch('updateCountry', country).then(() => {
                router.push('/user-settings');
            });
        }
    },
    computed: {
        ...mapGetters(['getCountriesList'])
    }
}
</script>