<template>
  <div class="w-full h-screen flex justify-center items-center">
    <div class="w-fit p-10 rounded-xl border flex justify-center">
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
            <option disabled selected>Select category</option>
            <option
              :selected="this.contentField.category.includes('3D Design')"
              value="3D Design"
            >
              3D Design
            </option>
            <option
              :selected="this.contentField.category.includes('Animation')"
              value="Animation"
            >
              Animation
            </option>
            <option
              :selected="this.contentField.category.includes('Documentation')"
              value="Documentation"
            >
              Documentation
            </option>
            <option
              :selected="this.contentField.category.includes('Illustration')"
              value="Illustration"
            >
              Illustration
            </option>
            <option
              :selected="this.contentField.category.includes('Photography')"
              value="Photography"
            >
              Photography
            </option>
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
            <router-link :to="{ name: 'dashboard' }" class="modal-action">
              <label
                for="my-modal"
                class="btn bg-red-600 border border-red-600 hover:bg-red-600 hover:border-red-600 hover:shadow-lg shadow-red-600"
                >Cancel</label
              >
            </router-link>
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
    };
  },

  methods: {
    onFileChange(e) {
      this.contentField.img_path = e.target.files[0];
    },

    async showById() {
      await axios
        .get(
          `${this.url}/content/${this.$route.params.id}?token=${localStorage.token}`
        )
        .then((res) => {
          this.contentField = res.data[0];
        })
        .catch((err) => {
          console.error(err);
        });
    },

    async submitData(e) {
      const formData = new FormData();
      formData.append("title", this.contentField.title);
      formData.append("description", this.contentField.description);
      formData.append("img_path", this.contentField.img_path);
      formData.append("category", this.contentField.category);

      await axios
        .put(
          `${this.url}/content/${this.$route.params.id}?token=${localStorage.token}`,
          formData
        )
        .then((res) => {
          this.$router.go("/dashboard");
          // document.getElementById("my-modal").checked = false;
          this.message = res.data.message;
        })
        .catch((err) => {
          console.error(err);
        });
    },
  },

  created() {
    this.showById();
  },
};
</script>
