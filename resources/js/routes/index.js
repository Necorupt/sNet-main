import { createRouter, createWebHistory } from "vue-router";

const router = createRouter({
    history: createWebHistory(),
    routes:[
        {
            path: "/",
            component: () => import("../views/Feed.vue"),
        },
        {
            path: "/friends",
            component: () => import("../views/Friends.vue"),
        },
        {
            path: "/subscribers",
            component: () => import("../views/Subscribers.vue"),
        },
        {
            path: "/profile/settings",
            component: () => import("../views/ProfileSettings.vue"),
        },
        {
            path: "/profile/settings",
            component: () => import("../views/ProfileSettings.vue"),
        },
        {
            path: "/profile/:id",
            component: () => import("../views/Profile.vue"),
        },
        {
            path: "/post/create",
            component: () => import("../views/CreatePost.vue"),
        },
        {
            path: "/post/:id",
            component: () => import("../views/Post.vue"),
        }
    ]
})

export default router
