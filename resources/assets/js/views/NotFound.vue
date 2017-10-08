<template>
    <div class="text-center">
        <h1>404</h1>

        <h3>We couldn't find the page..</h3>

        <p>Sorry, but the page you are looking for was either not found or does not exist. Try refreshing the page
            or click the link below to go back to the Homepage.</p>
        <p><router-link class="btn" to="/">Home</router-link></p>
    </div>
</template>

<script>
    export default {
        name: 'NotFound'
    }
</script>