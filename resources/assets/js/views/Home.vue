<template>
    <div class="text-center">
        <h1>Today's Survey</h1>
        <p>It looks like you didn't answer it yet!</p>
        <router-link class="btn btn-primary" to="/survey">
            Take it Now!
        </router-link>
    </div>
</template>

<script>
    export default {
        name: 'Home'
    }
</script>