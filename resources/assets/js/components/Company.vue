<template>
    <div class="container">
        <div class="alert alert-danger" role="alert" v-if="isShowError">
            <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
            <span class="sr-only">Error:</span>
            Company Name Required
        </div>

        <form>
            <div class="form-group col-sm-6 col-form-label">
                <label for="formGroupExampleInput">Company Name</label>
                <input v-on:keyup="keyUp" v-model="companyName" type="text" class="form-control" id="formGroupExampleInput" placeholder="Company Name">
            </div>

            <div class="offset-sm-2 col-sm-10">
                <button @click.prevent="search" type="submit" class="btn btn-primary">Search</button>
            </div>
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
            <ListingView :searchResults=searchResults.data></ListingView>
        </div>
        <div class="col-md-6 col-md-offset-3" v-if="isShowTypeHeadResults">
            <div v-for="result in typeHeadResults" class="list-group">
                <a href="#" @click.prevent="setSearchValue(result)" class="list-group-item">{{ result.applicable_name }}</a>
            </div>
        </div>
    </div>
</template>

<script type="text/babel">
    import ListingView from './ListingView.vue';
    import TypeHeadMixin from '../TypeHeadMixin';

    export default {
        mixins: [TypeHeadMixin],
        data() {
            return {
                companyName: '',
                searchResults: '',
                isShowSearchResults: false,
                isShowError: false
            }
        },
        components: {
            ListingView
        },
        methods: {
            /**
             * Get Data from the DB
             */
            search() {
                // Hide typehead search results
                this.isShowTypeHeadResults = false;

                let url = '/payment';
                if (this.companyName) {
                    url = '/payment?applicable_name=' + this.companyName;
                } else {
                    this.isShowError = true;
                    return;
                }

                axios.get(url).then(response => {
                    this.searchResults = response.data;
                    this.isShowSearchResults = true;
                });
            },

            /**
             * export results as xls file
             */
            exportResults() {
                window.location.href = '/export?applicable_name=' + this.companyName;
            },

            keyUp() {
                this.isShowError = false;
                this.typeHeadSearch('applicable_name', this.companyName);
            },
            /**
             * Set the search value
             *
             * @param result
             */
            setSearchValue(result)
            {
                this.companyName = result.applicable_name;
            }
        }
    }
</script>
