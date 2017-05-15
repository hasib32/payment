<template>
    <div class="container">
        <form>
            <div class="form-group col-sm-6 col-form-label">
                <label for="formGroupExampleInput">Hospital Name</label>
                <input v-model="hospitalName" type="text" class="form-control" id="formGroupExampleInput" placeholder="Hospital Name">
            </div>

            <div class="offset-sm-2 col-sm-10">
                <button @click.prevent="search" type="submit" class="btn btn-primary">Search</button>
            </div>
        </form>

        <div v-if="searchResults">
            <HospitalsList :searchResults=searchResults></HospitalsList>
        </div>
    </div>
</template>

<script type="text/babel">
    import HospitalsList from './HospitalsList.vue';

    export default {
        data() {
            return {
                hospitalName: '',
                searchResults: ''
            }
        },
        components: {
            HospitalsList
        },
        methods: {
            search() {
                let url = '/payment';
                if (!_.isEmpty(this.hospitalName)) {
                    url = '/payment?applicable_name=' + this.hospitalName;
                }

                axios.get(url).then(response => {
                    this.searchResults = response.data.data;
                });
            }
        }
    }
</script>
