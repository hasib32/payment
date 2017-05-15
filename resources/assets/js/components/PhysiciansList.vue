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
            <tr>
                <td>{{result.physician_first_name}}</td>
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
            result: {
                type: Object,
                required: true
            }
        }
    }
</script>
