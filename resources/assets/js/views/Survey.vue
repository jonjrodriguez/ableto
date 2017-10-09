<template>
    <div class="text-center">
        <h2>Survey</h2>

        <form @submit.prevent="submit">
            <question
                    v-for="question in questions"
                    :question="question"
                    :key="question.id"
                    v-model="answers[question.id].option_id"
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

        components: { Question },

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
            this.checkSubmitted();
            this.fetchData();
        },

        methods: {
            fetchData() {
                axios.get('/api/questions')
                    .then(response => {
                        this.questions = response.data.data;
                        this.answers = this.questions.reduce((acc, curr) => {
                            acc[curr.id] = { question_id: curr.id, option_id: 0 };
                            return acc;
                        }, {});
                    });
            },

            checkSubmitted() {
                axios.get(`/api/answers/${this.today}`)
                    .then(response => {
                        if (response.data.data.length) {
                            this.$router.push('/');
                        }
                    });
            },

            submit(e) {
                if (!this.valid) {
                    this.error = 'Please complete the form.';
                    return;
                }

                this.error = '';
                axios.post('/api/answers', this.answers)
                    .then(response => {
                       this.$router.push('/');
                    });
            }
        }
    }
</script>