<template>
    <div class="text-center">
        <current-survey :submission="current" />
        <past-surveys :submissions="submissions" />
    </div>
</template>

<script>
    import axios from 'axios';
    import CurrentSurvey from "../components/CurrentSurvey.vue";
    import PastSurveys from "../components/PastSurveys.vue";

    export default {
        name: 'Home',

        components: { CurrentSurvey, PastSurveys },

        data() {
            return {
                submissions: {}
            }
        },

        computed: {
            current() {
                return this.submissions[this.today] || [];
            },

            today() {
                const today = new Date();

                let year = today.getFullYear();
                let month = today.getMonth()+1;
                let day = today.getDate();

                if (day < 10) {
                    day = '0' + day;
                }
                if (month < 10) {
                    month = '0' + month;
                }

                return `${year}-${month}-${day}`;
            }
        },

        created() {
            this.fetchData();
        },

        methods: {
            fetchData() {
                axios.get('api/answers')
                    .then(response => {
                        this.submissions = response.data.data;
                    });
            }
        }
    }
</script>