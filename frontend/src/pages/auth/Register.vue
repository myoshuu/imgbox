<template>
  <div class="w-[100vw] h-[100vh] flex justify-center items-center">
    <form
      @submit.prevent="register"
      class="border border-black rounded-lg p-5 w-[400px]"
      action=""
    >
      <router-link class="text-blue-800" :to="{ name: 'home' }"
        >&LeftArrow; back to home</router-link
      >
      <h3 class="text-center text-xl font-bold my-5">Register</h3>
      <div class="flex flex-col gap-5">
        <div>
          Nama <br />
          <input
            class="border border-slate-500 rounded-lg p-2 w-full"
            type="text"
            name="nama"
            id="nama"
            placeholder="Your full name"
          />
        </div>
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
            placeholder="Your password"
          />
        </div>
        <div>
          Confirm Password
          <input
            class="border border-slate-500 rounded-lg p-2 w-full"
            type="password"
            name="confirm_password"
            id="confirm_password"
            placeholder="Confirm your password"
          />
        </div>
        <p class="text-[15px]">
          Already have any account?
          <router-link class="text-blue-800" :to="{ name: 'login' }"
            >Login</router-link
          >
        </p>
      </div>
      <button
        class="w-full mt-6 py-2 px-3 border border-black bg-black text-white rounded-lg hover:shadow-lg transition-shadow"
      >
        Register
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
    register(e) {
      const formData = new FormData(e.target);
      const values = Object.fromEntries(formData.entries());

      axios
        .post(`${this.url}/register`, values)
        .then((res) => {
          console.log(res.data.message);
          this.$router.push({ name: "login" });
        })
        .catch((err) => {
          console.log(err.response.data.message);
        });
    },
  },
};
</script>
