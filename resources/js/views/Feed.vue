<script setup>
import axios from "axios";
import HeaderCmp from "../components/HeaderCmp.vue";
import PostPreview from "../components/PostPreview.vue";
</script>

<template>
    <HeaderCmp></HeaderCmp>
    <div class="content">
        <div class="feed">
            <h1>Новости</h1>

            <div class="post-list">
                <PostPreview
                    v-for="post in posts"
                    key="id"
                    class="feed__post"
                    :link="'/post/' + post.id"
                    :title="post.title"
                    :likes="post.likes"
                    :comments="post.comments"
                ></PostPreview>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            selfInfo: {},
            posts: null,
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
        FetchPosts() {
            axios
                .get("/user/getPosts", {
                    params: { user_id: this.selfInfo.id },
                })
                .then((Response) => {
                    this.posts = Response.data.data;
                    console.log(this.posts);
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
};
</script>

<style lang="scss" scoped>
.content {
    padding-top: 200px;
    display: flex;
    flex-direction: row;
    justify-content: center;
}

.feed {
    background-color: #eeeeee;
    border-radius: 12px;
    padding: 32px;
    width: 80%;
}

.post-list {
    display: flex;
    flex-direction: column;
    gap: 10px;
    padding-top: 20px;
}
</style>
