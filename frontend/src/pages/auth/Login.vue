<template>
  <div class="w-[100vw] h-[100vh] flex justify-center items-center">
    <form
      @submit.prevent="login"
      class="border border-black rounded-lg p-5 w-[280px]"
      action=""
    >
      <router-link class="text-blue-800" :to="{ name: 'home' }"
        >&LeftArrow; back to home</router-link
      >
      <h3 class="text-center text-xl font-bold my-5">Login</h3>
      <div class="flex flex-col gap-5">
        <div>
          Email <br />
          <input
            class="border border-slate-500 rounded-lg p-2 w-full"
            type="email"
            name="email"
            id="email"
            placeholder="example@gmail.com"
          />
        </div>
        <div>
          Password
          <input
            class="border border-slate-500 rounded-lg p-2 w-full"
            type="password"
            name="password"
            id="password"
            placeholder="Your Password"
          />
        </div>
        <p class="text-[15px]">
          Didn't have any account?
          <router-link class="text-blue-800" :to="{ name: 'register' }"
            >Register</router-link
          >
        </p>
      </div>
      <button
        class="w-full mt-6 py-2 px-3 border border-black bg-black text-white rounded-lg hover:shadow-lg transition-shadow"
      >
        Login
      </button>
    </form>
  </div>
</template>
<script>
import axios from "axios";
export default {
  data() {
    return {};
  },

  methods: {
    login(e) {
      const formData = new FormData(e.target);
      const values = Object.fromEntries(formData.entries());

      axios
        .post(`${this.url}/login`, values)
        .then((res) => {
          localStorage.setItem("token", res.data.token);
          localStorage.setItem("name", res.data.user.nama);
          localStorage.setItem("id", res.data.user.id);

          this.$router.push({ name: "home" });
        })
        .catch((err) => {
          console.log(err.response.data.message);
        });
    },
  },
};
</script>
