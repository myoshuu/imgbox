<script setup>
import Navbar from "../components/Navbar.vue";
</script>
<template>
  <div>
    <Navbar class="mb-5" :prefix-name="prefixName" />
    <div class="px-10" v-for="content in contents" :key="content.id">
      <div class="w-[300px] border border-slate-500 rounded-lg">
        <img
          class="object-fit rounded-lg"
          :src="`http://localhost:8000/${content.img_path}`"
          alt=""
        />
        <div class="mt-2 p-4">
          <h1 class="font-medium text-xl">{{ content.title }}</h1>
          <p class="text-slate-500">{{ content.description }}</p>
          <span class="text-slate-400 text-xs">{{ content.user_nama }}</span>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import axios from "axios";
export default {
  data() {
    return {
      contents: [],
      prefixName: "",
      name: "",
    };
  },
  methods: {
    showAll() {
      axios
        .get(`${this.url}/content`)
        .then((res) => {
          this.contents = res.data;
        })
        .catch((err) => {
          console.log(err.response.data.message);
        });
    },
  },

  created() {
    this.showAll();
  },
};
</script>
