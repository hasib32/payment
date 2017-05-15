<template>
    <div class="container">
       <form>
                <div class="form-group col-sm-6 col-form-label">
                    <label for="formGroupExampleInput">First Name</label>
                    <input v-model="firstName" type="text" class="form-control" id="formGroupExampleInput" placeholder="First Name">
                </div>
                <div class="form-group col-sm-6 col-form-label">
                    <label for="formGroupExampleInput2">Last Name</label>
                    <input v-model="lastName" type="text" class="form-control" id="formGroupExampleInput2" placeholder="Last Name">
                </div>

                <div class="offset-sm-2 col-sm-10">
                    <button @click.prevent="search" type="submit" class="btn btn-primary">Search</button>
                </div>
       </form>
    </div>
</template>

<script type="text/babel">
    import Helpers from '../helper';

    export default {
       data() {
           return {
               firstName: '',
               lastName: '',
           }
        },
        methods: {
            search() {
                let queryObject = _.clone(this.$data);

                // remove empty object
                _.forOwn(queryObject, (value, key) => {
                    if (_.isEmpty(value)) {
                        delete queryObject[key]
                    }
                });

                let queryParms = Helpers.buildQueryParam(queryObject);

                axios.get('/payment' + '?' + queryParms).then(response => {
                    console.log(response.data);
                });
            }
        }
    }
</script>
