<template>
    <div class="container">
        <form>
            <div class="form-group col-sm-6 col-form-label">
                <label for="formGroupExampleInput">Company Name</label>
                <input v-model="companyName" type="text" class="form-control" id="formGroupExampleInput" placeholder="Company Name">
            </div>

            <div class="offset-sm-2 col-sm-10">
                <button @click.prevent="search" type="submit" class="btn btn-primary">Search</button>
            </div>
        </form>

        <div v-if="searchResults">
            <CompaniesList :searchResults=searchResults></CompaniesList>
        </div>
    </div>
</template>

<script type="text/babel">
    import CompaniesList from './CompaniesList.vue';

    export default {
        data() {
            return {
                companyName: '',
                searchResults: ''
            }
        },
        components: {
            CompaniesList
        },
        methods: {
            search() {
                let url = '/payment';
                if (!_.isEmpty(this.companyName)) {
                    url = '/payment?applicable_name=' + this.companyName;
                }

                axios.get(url).then(response => {
                    this.searchResults = response.data.data;
                });
            }
        }
    }
</script>
