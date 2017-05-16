<template>
    <div class="container">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Physician Name</th>
                <th>Specialty</th>
                <th>Primary Address</th>
            </tr>
            </thead>
            <tbody>
            <tr  v-for="result in searchResults">
                <td>{{result.physician_first_name }} {{result.physician_last_name}}</td>
                <td>{{result.physician_specialty}}</td>
                <td>{{result.physician_license_state_code1}}</td>
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
