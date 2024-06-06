<template>
    <HeaderCmp></HeaderCmp>
    <div v-if="isUserExist" class="profile">
        <div class="profile__top">
            <div class="profile__text--data">
                <div class="profile__text--item">
                    <h2>{{ user.name }}</h2>
                    <h2>{{ user.lastname }}</h2>
                </div>
                <div class="profile__text--item">
                    <h2> Создан </h2>
                    <h2>{{ user.created_at }}</h2>
                </div>
            </div>
            <img ref="userAvatar" class="profile__avatar">
        </div>

        <div class="profile__posts">
            <h1> Посты</h1>

            <a v-for="post in posts" key="id" class="feed__post" :href="'/post/'+post.id">
                <h2>{{ post.title }}</h2>
                <h4>лайки {{ post.likes }}</h4>
                <h4>комменты {{ post.comments }}</h4>
            </a>
        </div>
    </div>
    <div v-else class="profile--not-exist">
        <h1> Пользователь не существует</h1>
    </div>
</template>

<script setup>

import HeaderCmp from "../components/HeaderCmp.vue"

</script>
<script>

import axios from "axios"

export default {
    data() {

        return {
            user: {},
            isUserExist: true,
            posts: {},
        }
    },
    mounted() {
        axios.get('/user/getUserInfoById', {
            params: { id: this.$route.params.id }
        }).then((Response) => {
            let data = Response.data;
            if (data.hasError == false) {
                this.user = data.data;
                this.$refs.userAvatar.src = "/" + this.user.avatar_url;
            }
            else {
                this.isUserExist = false;
            }
        }).catch(function (error) {
            console.log(error);
        });

        axios.get('/posts/getById', {
            params: { id: this.$route.params.id }
        }).then((Response) => {
            let data = Response.data;
            console.log(data);
            if (data.hasError == false) {
                this.posts = data.data;
            }
            else {

            }
        }).catch(function (error) {
            console.log(error);
        });


    },
}

</script>

<style lang="scss" scoped>
.profile--not-exist {
    margin-top: 200px;
}

.profile {
    margin-top: 200px;
    width: calc(100% - 28px * 2);
    padding: 28px;

    &__top {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
    }

    &__text--item {
        display: flex;
        gap: 20px;
    }

    &__avatar {
        border-radius: 50%;
        object-fit: cover;
        width: 400px;
        height: 400px;
    }

    &__posts{
        display:flex;
        flex-direction:column;
        gap:20px;
        border-top:1px solid gray;
    }

    &__post{
        text-decoration: none;
        color: white;
    }
}
</style>
