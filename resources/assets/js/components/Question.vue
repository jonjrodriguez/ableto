<template>
    <div class="m-b-2 m-t-2">
        <h4>{{ question.text }}</h4>
        <div class="form-group">
            <label class="radio-inline" v-for="option in question.options">
                <input type="radio" :name="`question${question.id}`" id="option.id" value="option.id" :checked="value === option.id ? 'checked' : ''" @click="update(option)">
                {{ option.text }}
            </label>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'Question',

        props: {
            value: {
                type: String|Number,
                required: true
            },

            question: {
                type: Object,
                required: true
            }
        },

        methods: {
            update(option) {
                this.$emit('input', option.id);
            }
        }
    }
</script>