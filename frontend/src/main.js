import { createApp } from "vue";
import "./style.css";
import App from "./App.vue";
import router from "./router";

import axios from "axios";

const app = createApp(App);
app.use(router);
app.config.globalProperties.url = "http://localhost:8000/api";
app.mount("#app");
