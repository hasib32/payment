<template>
    <div class="container">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Physician Name</th>
                <th>Physician Specialty</th>
                <th>Teaching Hospital Name</th>
                <th>Teaching Hospital ID</th>
                <th>Company Making Payment</th>
                <th>Company Address</th>
            </tr>
            </thead>
            <tbody>
            <tr  v-for="result in searchResults">
                <td>{{result.physician_first_name }} {{result.physician_last_name}}</td>
                <td>{{result.physician_specialty}}</td>
                <td>{{result.teaching_hospital_name}}</td>
                <td>{{result.teaching_hospital_id}}</td>
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
