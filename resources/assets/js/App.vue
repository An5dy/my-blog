<template>
    <div id="app">
        <router-view/>
    </div>
</template>

<script>
    export default {
        name: 'app'
    }
</script>

<style>
    body {
        height: 100%;
        overflow: hidden;
        top: 0;
        bottom: 0;
        background-color: white;
    }
    a {
        text-decoration: none;
        color: #303133;
    }
    a:hover {
        text-decoration: none;
        color: #303133;
    }
</style>
