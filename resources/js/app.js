require("./bootstrap");

// Import modules...
import Vue from "vue";
import {
    App as InertiaApp,
    plugin as InertiaPlugin
} from "@inertiajs/inertia-vue";
import PortalVue from "portal-vue";

Vue.mixin({ methods: { route } });
Vue.use(InertiaPlugin);
Vue.use(PortalVue);

const app = document.getElementById("app");

Vue.filter("truncate", function(text, stop, clamp) {
    return text.slice(0, stop) + (stop < text.length ? clamp || "..." : "");
});

//Sweet alert
import swal from "sweetalert2";
window.swal = swal;

const Toast = swal.mixin({
    toast: true,
    position: "bottom-end",
    showConfirmButton: false,
    background: ""
});
window.toast = Toast;

//Progress
import { InertiaProgress } from "@inertiajs/progress";

InertiaProgress.init({
    delay: 0,
    color: "white",
    includeCSS: true,
    showSpinner: false
});

//Vuelidate
import Vuelidate from "vuelidate";
Vue.use(Vuelidate);

new Vue({
    render: h =>
        h(InertiaApp, {
            props: {
                initialPage: JSON.parse(app.dataset.page),
                resolveComponent: name => require(`./Pages/${name}`).default
            }
        })
}).$mount(app);
