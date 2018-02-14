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
        position: absolute !important;
        background-color: #f8f8f9 !important;
        top: 0;
        left: 0;
        right: 0;
        min-height: 100%;
        font-size: 15px !important;
        margin: 0 0;
    }
    pre {
      overflow: auto;
      line-height: 1.45;
      background-color: #4e4e4e;
      border-radius: 3px;
      color: #fff;
      border: none;
      padding: 10px 5px;
    }
    pre code {
      font-size: 13px;
    }
</style>
