<template>
    <div class="container">
       <form>
                <div class="form-group col-sm-6 col-form-label">
                    <label for="formGroupExampleInput">First Name</label>
                    <input v-on:keyup="keyUpFirstName" v-model="physician_first_name" type="text" class="form-control" id="formGroupExampleInput" placeholder="First Name">
                </div>
                <div class="form-group col-sm-6 col-form-label">
                    <label for="formGroupExampleInput2">Last Name</label>
                    <input v-on:keyup="keyUpLastName" v-model="physician_last_name" type="text" class="form-control" id="formGroupExampleInput2" placeholder="Last Name">
                </div>

                <div class="offset-sm-2 col-sm-10">
                    <button @click.prevent="search" type="submit" class="btn btn-primary">Search</button>
                </div>
           <p><span class="glyphicons glyphicons-download-alt"></span></p>
       </form>

        <div v-if="isShowSearchResults">
            <div class="col-sm-6">
                <h2>Showing {{searchResults.data.length}} Results of {{searchResults.total}}</h2>
            </div>
            <div class="col-sm-6">
                <button type="button" class="btn btn-primary" @click="exportResults">
                    <span class="glyphicon glyphicon-download-alt"></span> Download Full Results
                </button>
            </div>
            <PhysiciansList :searchResults=searchResults.data></PhysiciansList>
        </div>
        <div class="col-md-6 col-md-offset-3" v-if="isShowTypeHeadResults">
            <div v-for="result in typeHeadResults" class="list-group">
                <a href="#" @click.prevent="setSearchValue(result)" class="list-group-item">{{ result.physician_first_name }} {{ result.physician_last_name }}</a>
            </div>
        </div>
    </div>
</template>

<script type="text/babel">
    import Helpers from '../helper';
    import PhysiciansList from './PhysiciansList.vue';
    import TypeHeadMixin from '../TypeHeadMixin';

    export default {
        mixins: [TypeHeadMixin],
       data() {
           return {
               physician_first_name: '',
               physician_last_name: '',
               searchResults: '',
               isShowTypeHeadResults: false,
               isShowSearchResults: false,
           }
        },
        components: {
            PhysiciansList
        },
        methods: {
            /**
             * Search and get data from the DB
             */
            search() {
                // Hide typehead search results
                this.isShowTypeHeadResults = false;

                let queryParms = this.getQueryParams();

                axios.get('/payment' + '?' + queryParms).then(response => {
                    this.searchResults = response.data;
                    this.isShowSearchResults = true;
                });
            },

            /**
             * export results as xls file
             */
            exportResults() {
                let queryParms = this.getQueryParams();
                window.location.href = '/export?' + queryParms;
            },

            /**
             * get query params for search
             *
             * @returns {*|string}
             */
            getQueryParams() {
                let queryObject = {
                    physician_first_name: this.physician_first_name,
                    physician_last_name: this.physician_last_name
                };

                return Helpers.buildQueryParam(queryObject);
            },
            /**
             * first_name key up action
             */
            keyUpFirstName() {
                this.typeHeadSearch('physician_first_name', this.physician_first_name);
            },

            /**
             * last_name key up action
             */
            keyUpLastName() {
                this.typeHeadSearch('physician_last_name', this.physician_last_name);
            },

            /**
             * Set the search value
             *
             * @param result
             */
            setSearchValue(result)
            {
                this.physician_first_name = result.physician_first_name;
                this.physician_last_name = result.physician_last_name;
            }
        }
    }
</script>
