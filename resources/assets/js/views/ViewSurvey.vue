<template>
    <div class="text-center">
        <h1>Survey for {{ date }}</h1>

        <p>Thanks for submitting. Here are your previous answers:</p>
        <answer
                v-for="answer in submission"
                :answer="answer"
                :key="answer.id"
        />

        <router-link class="btn btn-link" to="/">Back</router-link>
    </div>
</template>

<script>
    import axios from 'axios';
    import Answer from '../components/Answer.vue';

    export default {
        name: 'ViewSurvey',

        components: { Answer },

        props: {
            date: {
                type: String,
                required: true
            }
        },

        data() {
            return {
                submission: []
            }
        },

        created() {
            this.fetchData();
        },

        methods: {
            fetchData() {
                axios.get(`/api/answers/${this.date}`)
                    .then(response => {
                        this.submission = response.data.data;
                    });
            }
        }
    }
</script>