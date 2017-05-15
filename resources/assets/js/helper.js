export default {
    /**
     * Build query parameter from given object
     *
     * @param queryObject
     * @returns {string}
     */
    buildQueryParam(queryObject)
    {
        let esc = encodeURIComponent;

        return Object.keys(queryObject)
                .map(key => esc(key) + '=' + esc(queryObject[key]))
                .join('&');
    }
}