<template>
  <nav class="flex items-center justify-between px-10 py-5">
    <p class="font-bold text-xl">ImgBox</p>
    <ul>
      <div class="flex gap-5" v-if="!token">
        <li><router-link :to="{ name: 'login' }">Login</router-link></li>
        <li>
          <router-link
            class="border bg-black text-white px-5 py-2 rounded-lg hover:bg-white hover:border-black transition-all hover:text-black"
            :to="{ name: 'register' }"
            >Register</router-link
          >
        </li>
      </div>
      <div v-else>
        <div
          @click="showModal"
          class="avatar placeholder cursor-pointer transition-all"
        >
          <div class="bg-slate-300 rounded-full w-12">
            <span class="text-lg">{{
              name
                .split(/\s/)
                .reduce((response, word) => (response += word.slice(0, 1)), "")
            }}</span>
          </div>
        </div>
        <div id="modal" class="absolute right-10 mt-3 hidden transition-all">
          <ul
            tabindex="0"
            class="dropdown-content menu p-2 border bg-base-100 rounded-box w-52"
          >
            <router-link class="w-full" :to="{ name: 'dashboard' }">
              <li>
                <div class="flex items-center">
                  <i class="fa-solid fa-gauge"></i>
                  <span class="font-medium"> Dashboard </span>
                </div>
              </li>
            </router-link>
            <li @click.prevent="logout" class="hover:bg-red-600 rounded-lg">
              <div class="flex items-center hover:text-white">
                <i class="fa-solid fa-right-from-bracket"></i>
                <span class="font-medium">Logout</span>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </ul>
  </nav>
</template>
<script>
import axios from "axios";
export default {
  data() {
    return {
      token: localStorage.token,
      name: localStorage.name,
    };
  },

  methods: {
    showModal() {
      document.getElementById("modal").classList.toggle("hidden");
    },

    logout() {
      axios
        .post(`${this.url}/logout`)
        .then((res) => {
          localStorage.clear();
          console.log(res.data.message);
          location.reload();
        })
        .catch((err) => {
          console.log(err.response.data.message);
        });
    },
  },
};
</script>
