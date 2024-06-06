<script setup>
import axios from "axios";
import HeaderCmp from "../components/HeaderCmp.vue";
</script>

<template>
    <HeaderCmp></HeaderCmp>
    <div class="feed">
        <h1>Новости</h1>

        <div class="feed__create-post">
            <input
                type="text"
                placeholder="title"
                v-model="createPostInfo.title"
            />
            <input
                type="text"
                placeholder="текст"
                v-html="createPostInfo.text"
            />

            <button @click="createPost">создать</button>
        </div>

        <div class="post-list">
            <a
                v-for="post in posts"
                key="id"
                class="feed__post"
                :href="'/post/' + post.id"
            >
                <h2>{{ post.title }}</h2>
                <h4>лайки {{ post.likes }}</h4>
                <h4>комменты {{ post.comments }}</h4>
            </a>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            selfInfo: {},
            posts: {},
            createPostInfo: {
                title: "",
                text: "",
            },
        };
    },
    mounted() {
        axios.get("/profile/getSelfInfo").then((Response) => {
            if (Response.data.hasError == false) {
                this.selfInfo = Response.data.data;
                this.FetchPosts();
            } else {
            }
        });
    },
    methods: {
        createPost() {
            axios
                .post("/posts/create", this.createPostInfo)
                .then((Response) => {
                    console.log(Response);

                    if (Response.data.hasError == false) {
                        this.posts.push(this.createPostInfo);
                        this.createPostInfo.text = this.createPostInfo.title =
                            "";
                    }
                });
        },
        FetchPosts() {
            axios
                .get("/user/getPosts", {
                    params: { user_id: this.selfInfo.id },
                })
                .then((Response) => {
                    console.log(Response);
                    this.posts = Response.data.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        likePost(postId) {
            axios.post("/posts/like", { dst_id: postId }).then((Response) => {
                console.log(Response);

                if (Response.data.error) {
                    this.posts.push(this.createPostInfo);
                    this.createPostInfo.text = this.createPostInfo.title = "";
                }
            });
            console.log(postId);
        },
    },
};
</script>

<style lang="scss" scoped>
.feed {
    margin-top: 200px;

    &-post {
        border: 1px solid black;
        padding: 10px;
    }
}

.post-list {
    display: flex;
    flex-direction: column;
    gap: 10px;
    padding-top: 20px;
}

.feed{
    &__post{
        text-decoration: none;
        color: white;
    }
}
</style>
