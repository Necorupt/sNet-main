import "./bootstrap";
import { createApp } from "vue";
import router from './routes/index'
import App from "./App.vue";
import "./resources/app.scss"

const app = createApp(App);

app.use(router)
app.mount("#app");