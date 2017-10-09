<template>
    <div>
        <h1>Today's Survey</h1>

        <div v-if="!submission.length">
            <p>It looks like you didn't answer it yet!</p>
            <router-link class="btn btn-primary" to="/survey">
                Take it Now!
            </router-link>
        </div>

        <div v-else>
            <p>Thanks for answering. Here are today's answers:</p>
            <answer
                    v-for="answer in submission"
                    :answer="answer"
                    :key="answer.id"
            />
        </div>
    </div>
</template>

<script>
    import Answer from './Answer.vue';

    export default {
        name: 'CurrentSurvey',

        components: { Answer },

        props: {
            submission: {
                type: Array,
                required: true
            }
        }
    }
</script>