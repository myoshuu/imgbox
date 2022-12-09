<template>
  <div class="p-10">
    <p class="font-medium text-2xl">Upload Content</p>

    <div class="my-5">
      <div class="flex justify-between items-center">
        <label for="my-modal" class="btn">&plus; Add content</label>
        <input
          class="border border-black py-2 px-5 rounded-lg w-[30rem]"
          type="text"
          v-model="search"
          placeholder="Search"
        />
      </div>

      <input type="checkbox" id="my-modal" class="modal-toggle" />
      <div class="modal">
        <div class="modal-box">
          <form
            action=""
            @submit.prevent="submitData"
            enctype="multipart/form-data"
          >
            <div class="flex flex-col gap-5">
              <div>
                <p class="mb-2">Title</p>
                <input
                  class="border border-slate-500 rounded-lg p-2 w-full"
                  type="text"
                  name="title"
                  id="title"
                  placeholder="Content title"
                  v-model="contentField.title"
                />
              </div>
              <div>
                <p class="mb-2">Description</p>
                <textarea
                  class="border border-slate-500 rounded-lg p-2 w-full"
                  name="description"
                  id="description"
                  placeholder="Content description"
                  cols="10"
                  rows="5"
                  v-model="contentField.description"
                ></textarea>
              </div>
              <select
                name="category"
                v-model="contentField.category"
                class="select select-bordered w-full"
              >
                <option selected disabled>Select category</option>
                <option value="3D Design">3D Design</option>
                <option value="Animation">Animation</option>
                <option value="Documentation">Documentation</option>
                <option value="Illustration">Illustration</option>
                <option value="Photography">Photography</option>
              </select>
              <div>
                <input
                  type="file"
                  name="img_path"
                  id="img_path"
                  class="file-input file-input-bordered w-full max-w-xs"
                  @change="onFileChange"
                />
              </div>
              <div class="flex gap-2 justify-end">
                <div class="modal-action">
                  <label
                    for="my-modal"
                    class="btn bg-red-600 border border-red-600 hover:bg-red-600 hover:border-red-600 hover:shadow-lg shadow-red-600"
                    >Cancel</label
                  >
                </div>
                <button
                  class="mt-6 py-[11px] px-3 border border-black bg-black text-white rounded-lg hover:shadow-lg transition-shadow"
                >
                  Submit
                </button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

    <table class="table w-full">
      <!-- head -->
      <thead>
        <tr>
          <th>#</th>
          <th>Title</th>
          <th>Description</th>
          <th>Image</th>
          <th>Category</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <!-- row 1 -->
        <tr v-for="(content, index) in filteredList" :key="content.id">
          <th>{{ content.id }}</th>
          <td>{{ content.title }}</td>
          <td>{{ content.description }}</td>
          <td>
            <img
              class="object-fit w-[500px]"
              :src="`http://localhost:8000/uploads/${content.img_path}`"
              alt="aaa"
            />
          </td>
          <td>{{ content.category }}</td>
          <td>
            <router-link
              class="group py-3 px-4 rounded-lg hover:bg-green-500 transition-all"
              :to="{ name: 'edit', params: { id: content.id } }"
            >
              <i class="fa-solid fa-pen text-sm group-hover:text-white"></i>
            </router-link>
            <button
              class="group py-3 px-4 rounded-lg hover:bg-red-500 transition-all"
              @click="deleteData(content.id, index)"
            >
              <i class="fa-solid fa-trash text-sm group-hover:text-white"></i>
            </button>
          </td>
        </tr>
      </tbody>
    </table>
  </div>
</template>
<script>
import axios from "axios";
export default {
  data() {
    return {
      contents: [],
      contentField: {
        title: "",
        description: "",
        img_path: "",
        category: [],
      },
      message: "",
      search: "",
    };
  },

  methods: {
    onFileChange(e) {
      this.contentField.img_path = e.target.files[0];
    },

    async submitData(e) {
      const formData = new FormData();
      formData.append("title", this.contentField.title);
      formData.append("description", this.contentField.description);
      formData.append("img_path", this.contentField.img_path);
      formData.append("category", this.contentField.category);

      await axios
        .post(`${this.url}/content?token=${localStorage.token}`, formData)
        .then((res) => {
          this.$router.go("/dashboard");
          // document.getElementById("my-modal").checked = false;
          this.message = res.data.message;
        })
        .catch((err) => {
          console.error(err);
        });
    },

    async deleteData(id, index) {
      await axios
        .post(`${this.url}/content/${id}?token=${localStorage.token}`)
        .then((res) => {
          this.message = res.data.message;
          this.contents.splice(index, 1);
        })
        .catch((err) => {
          console.error(err);
        });
    },

    async showById() {
      await axios
        .get(
          `${this.url}/content/user/${localStorage.id}?token=${localStorage.token}`
        )
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

  mounted() {
    this.showById();
  },
};
</script>
