<template>
  <div class="p-10">
    <p class="font-medium text-2xl">Upload Content</p>

    <div class="my-5">
      <label for="my-modal" class="btn">&plus; Add content</label>

      <input type="checkbox" id="my-modal" class="modal-toggle" />
      <div class="modal">
        <div class="modal-box">
          <form action="">
            <div class="flex flex-col gap-5">
              <div>
                Title <br />
                <input
                  class="border border-slate-500 rounded-lg p-2 w-full"
                  type="text"
                  name="title"
                  id="title"
                  placeholder="Content title"
                />
              </div>
              <div>
                Description <br />
                <textarea
                  class="border border-slate-500 rounded-lg p-2 w-full"
                  name="description"
                  id="description"
                  placeholder="Content description"
                  cols="10"
                  rows="5"
                ></textarea>
              </div>
              <div>
                <input
                  type="file"
                  name="img_path"
                  id="img_path"
                  class="file-input file-input-bordered w-full max-w-xs"
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

    <div class="overflow-x-auto">
      <table class="table w-full">
        <!-- head -->
        <thead>
          <tr>
            <th></th>
            <th>Title</th>
            <th>Description</th>
            <th>Image</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <!-- row 1 -->
          <tr>
            <th>1</th>
            <td>Cy Ganderton</td>
            <td>Quality Control</td>
            <td>Blue</td>
          </tr>
          <!-- row 2 -->
          <tr>
            <th>2</th>
            <td>Hart Hagerty</td>
            <td>Desktop Support Technician</td>
            <td>Purple</td>
          </tr>
          <!-- row 3 -->
          <tr>
            <th>3</th>
            <td>Brice Swyre</td>
            <td>Tax Accountant</td>
            <td>Red</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      content: [],
    };
  },
};
</script>
