<template>
    <div class="text-center">
        <h2>Survey</h2>

        <form @submit.prevent="submit">
            <question
                    v-for="question in questions"
                    :question="question"
                    :key="question.id"
                    v-model="answers[question.id]"
            />

            <button class="btn btn-primary" type="submit">
                Submit
            </button>

            <router-link class="btn btn-link" to="/">Cancel</router-link>

            <p class="text-danger">{{ error }}</p>
        </form>
    </div>
</template>

<script>
    import axios from 'axios';
    import Question from '../components/Question.vue';

    export default {
        name: 'Survey',

        components: {Question},

        data() {
            return {
                questions: [],
                answers: {},
                error: ''
            }
        },

        computed: {
            valid() {
                for (let id in this.answers) {
                    if (!this.answers[id]) {
                        return false;
                    }
                }

                return true;
            }
        },

        created() {
            this.fetchData();
        },

        methods: {
            fetchData() {
                axios.get('/api/questions')
                    .then(response => {
                        this.questions = response.data.data;
                        this.answers = this.questions.reduce((acc, curr) => {
                            acc[curr.id] = 0;
                            return acc;
                        }, {});
                    });
            },

            submit(e) {
                if (!this.valid) {
                    this.error = 'Please complete the form.';
                    return;
                }

                this.error = '';
                axios.post('/api/answers')
                    .then(response => {
                       console.log(response);
                    });
            }
        }
    }
</script>