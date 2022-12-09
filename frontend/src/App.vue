<template>
  <router-view></router-view>
</template>
<script>
export default {
  data() {
    return {
      token: localStorage.token,
    };
  },

  mounted() {},
};
</script>
