var typeHeadMixin = {
    data() {
        return {
            typeHeadResults: '',
        }
    },
    methods: {
        /**
         * typeHead search
         *
         * @param searchKey
         * @param searchValue
         */
        typeHeadSearch(searchKey, searchValue) {
            // Hide search results
            this.isShowSearchResults = false;

            if (searchValue.length < 2) return;

            let queryParms = searchKey + '=' + searchValue;

            axios.get('/payment' + '?' + queryParms).then(response => {
                this.isShowTypeHeadResults = true;
                this.typeHeadResults = response.data.data;
            });
        },
    }
};

export default typeHeadMixin;