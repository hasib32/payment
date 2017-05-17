export default {
    /**
     * Build query parameter from given object
     *
     * @param queryObject
     * @returns {string}
     */
    buildQueryParam(queryObject)
    {
        // remove empty object
        _.forOwn(queryObject, (value, key) => {
            if (_.isEmpty(value)) {
                delete queryObject[key]
            }
        });

        let esc = encodeURIComponent;

        return Object.keys(queryObject)
                .map(key => esc(key) + '=' + esc(queryObject[key]))
                .join('&');
    }
}