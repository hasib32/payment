<template>
    <div class="container">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Company Name</th>
                <th>Company Address</th>
            </tr>
            </thead>
            <tbody>
            <tr  v-for="result in searchResults">
                <td>{{result.applicable_name}}</td>
                <td>{{result.applicable_payment_state}}</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script type="text/babel">
    export default {
        props: {
            searchResults: {
                required: true
            }
        }
    }
</script>
