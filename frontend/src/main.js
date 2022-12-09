import { createApp } from "vue";
import "./style.css";
import App from "./App.vue";
import router from "./router";

import Vueform from "@vueform/vueform/plugin";
import vueformConfig from "./../vueform.config.js";

const app = createApp(App);
app.use(router);
app.use(Vueform, vueformConfig);
app.config.globalProperties.url = "http://localhost:8000/api";
app.mount("#app");
