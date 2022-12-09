<script setup>
import Navbar from "../components/Navbar.vue";
</script>
<template>
  <div>
    <Navbar class="mb-5" />
    <div class="flex justify-center px-10 mb-12">
      <input
        class="border border-black py-2 px-5 rounded-lg w-[30rem]"
        type="text"
        v-model="search"
        placeholder="Search"
      />
    </div>
    <div class="flex flex-wrap justify-center gap-10 px-10">
      <div class="" v-for="content in filteredList" :key="content.id">
        <div class="w-[300px] border border-slate-500 rounded-lg">
          <img
            class="object-fit rounded-lg"
            :src="`http://localhost:8000/uploads/${content.img_path}`"
            alt=""
          />
          <div class="mt-2 p-4">
            <h1 class="font-medium text-xl">{{ content.title }}</h1>
            <p class="text-slate-500">{{ content.description }}</p>
            <p class="text-[14px] mt-3 text-slate-500">
              Category :
              <span
                class="font-semibold px-3 py-1 bg-slate-300 text-white rounded-lg"
                >{{ content.category }}</span
              >
            </p>
            <span class="text-slate-400 text-xs">{{ content.user_nama }}</span>
          </div>
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
      name: "",
      search: "",
    };
  },
  methods: {
    async showAll() {
      await axios
        .get(`${this.url}/content`)
        .then((res) => {
          this.contents = res.data;
        })
        .catch((err) => {
          console.log(err.response.data.message);
        });
    },
  },

  computed: {
    filteredList() {
      return this.contents.filter((content) => {
        return content.title.toLowerCase().includes(this.search.toLowerCase());
      });
    },
  },

  created() {
    this.showAll();
  },
};
</script>
