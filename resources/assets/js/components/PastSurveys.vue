<template>
    <div class="panel panel-default m-t-2">
        <div class="panel-heading" @click="show = !show" style="cursor: pointer">Past Surveys</div>
        <div v-show="show">
            <div class="panel-body" v-if="submissions.length == 0">
                <p>You haven't submitted any past surveys.</p>
            </div>
            <ul class="list-group m-b-0" v-else>
                <router-link
                        class="list-group-item"
                        v-for="(value, key) in submissions"
                        :to="`/survey/${key}`"
                        :key="key">
                    {{ key }}
                </router-link>
            </ul>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'PastSurveys',

        props: {
            submissions: {
                type: Object | Array,
                required: true
            }
        },

        data() {
            return {
                show: false
            }
        }
    }
</script>