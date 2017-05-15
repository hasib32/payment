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
    </div>
</template>

<script type="text/babel">
    export default {
        data() {
            return {
                companyName: ''
            }
        },
        methods: {
            search() {
                console.log('came here');
            }
        }
    }
</script>
