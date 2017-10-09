<template>
    <div>
        <p><strong>{{ answer.question.text }}</strong></p>
        <p><em>{{ answer.option.text }}</em></p>
    </div>
</template>

<script>
    export default {
        name: 'Answer',

        props: {
            answer: {
                type: Object,
                required: true
            }
        }
    }
</script>

