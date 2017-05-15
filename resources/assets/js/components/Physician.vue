<template>
    <div class="container">
       <form>
                <div class="form-group col-sm-6 col-form-label">
                    <label for="formGroupExampleInput">First Name</label>
                    <input v-model="physician_first_name" type="text" class="form-control" id="formGroupExampleInput" placeholder="First Name">
                </div>
                <div class="form-group col-sm-6 col-form-label">
                    <label for="formGroupExampleInput2">Last Name</label>
                    <input v-model="physician_last_name" type="text" class="form-control" id="formGroupExampleInput2" placeholder="Last Name">
                </div>

                <div class="offset-sm-2 col-sm-10">
                    <button @click.prevent="search" type="submit" class="btn btn-primary">Search</button>
                </div>

                <div v-for="result in searchResults">
                    <PhysiciansList :result=result></PhysiciansList>
                </div>
       </form>
    </div>
</template>

<script type="text/babel">
    import Helpers from '../helper';
    import PhysiciansList from './PhysiciansList.vue'

    export default {
       data() {
           return {
               physician_first_name: '',
               physician_last_name: '',
               searchResults: []
           }
        },
        components: {
            PhysiciansList
        },
        methods: {
            search() {
                let queryObject = {
                    physician_first_name: this.physician_first_name,
                    physician_last_name: this.physician_last_name
                };

                // remove empty object
                _.forOwn(queryObject, (value, key) => {
                    if (_.isEmpty(value)) {
                        delete queryObject[key]
                    }
                });

                let queryParms = Helpers.buildQueryParam(queryObject);

                axios.get('/payment' + '?' + queryParms).then(response => {
                    this.searchResults = response.data.data;
                });
            }
        }
    }
</script>
