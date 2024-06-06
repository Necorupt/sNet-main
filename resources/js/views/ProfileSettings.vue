<template>
    <HeaderCmp></HeaderCmp>
    <div class="profile--settings">
        <form enctype="multipart/form-data" class="profile--settings__content" @submit.prevent="submit">
            <div class="settings__header">
                <h2>Параметры профиля</h2>
            </div>
            <div class="settings__mid">
                <div class="settings__text">
                    <div class="settings__parameter">
                        <h2>имя:</h2>
                        <input placeholder="имя" name="name" class="input--field--light" v-model="user.name">
                    </div>
                    <div class="settings__parameter">
                        <h2>фамилия:</h2>
                        <input placeholder="фамилия" name="lastname" class="input--field--light"
                            v-model="user.lastname">
                    </div>
                    <div class="settings__parameter">
                        <h2>почта:</h2>
                        <input placeholder="почта" name="email" class="input--field--light" v-model="user.email">
                    </div>
                    <div class="settings__parameter">
                        <h2>userID:</h2>
                        <input placeholder="userID" class="input--field--light">
                    </div>
                </div>
                <div class="settings__photo">
                    <input type="file" @change="uploadFile" name="avatar_image"
                        class="button--s settings__apply--button" ref="avatar_image">
                </div>
            </div>
            <div class="settings__bottom">
                <button class="button--s settings__denie--button">отменить</button>
                <button type="submit" class="button--s settings__apply--button">сохранить</button>
            </div>
        </form>
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
            isLogined: true,
            File: null,
        }
    },
    mounted() {
        let result = axios.get('/profile/getSelfInfo').then((Response) => {
            console.log(Response)
            if (Response.data.hasError == false) {
                this.user = Response.data.data;
            }
            else {
                this.isLogined = false;
            }
        });
    },
    methods: {
        uploadFile() {
            this.File = this.$refs.avatar_image.files[0];
            console.log(this.File);
        },
        submit() {
            console.log(this.$refs.avatar_image);
            let formData = new FormData();
            formData.append("avatar_image",this.File);
            formData.append("lastname",this.user.lastname);
            formData.append("name",this.user.name);

            axios.post("/user/update", formData, {
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                }
            }).then((Response) => {
                if (Response.status == 200)
                    window.location.href = "/";
            });
        }
    }
}

</script>

<style scoped lang="scss">
.profile--settings {

    background: rgba(146, 146, 146, 0.2);
    padding: 150px 28px;

    &__user--name {
        color: #7A7A7A;
    }

    &__content {
        display: flex;
        flex-direction: column;
        gap: 16px;
        background-color: white;
        border-radius: 20px;
        padding: 28px;

    }

    .settings__mid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
    }

    .settings__parameter {
        display: flex;
        flex-direction: column;
        gap: 10px;
        padding: 10px 0px;
    }

    .settings__bottom {
        display: flex;
        justify-content: space-between;

    }

    .settings__denie--button {
        background-color: #de3821;
        color: white;
    }


    .settings__apply--button {
        background-color: #34A932;
        color: white;
    }
}
</style>