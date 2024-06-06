<template>
    <div class="header">
        <div ref="headerMenu" class="header__nav--disabled">
            <img @click="hideMenu" src="../resources/icons/bars-solid.svg" class="header__menu--button"></img>
            <a class="nav-menu-link" href="/"> Новости </a>
            <a class="nav-menu-link" href="/friends"> Друзья </a>
            <a class="nav-menu-link" href="/subscribers"> Подписчики </a>
            <a class="nav-menu-link" href="/profile/settings"> Параметры </a>
            <a class="nav-menu-link" href="/post/create"> Создать пост </a>
            <a class="nav-menu-link" @click="logout"> выйти </a>
        </div>
        <div class="header__left">
            <img @click="showMenu" src="../resources/icons/bars-solid.svg" class="header__menu--button"></img>
            <h2>sNet</h2>
        </div>
        <div @click="goToProfile" v-if="isLogined" class="header__right">
            <img class="header__avatar" ref="avatarImage">
            <h2 class="header__user--name">{{ user.name }}</h2>
        </div>
        <div v-else="isLogined" class="header__right">
            <a href="/register"> зарегестрироваться </a>
            <a href="/login"> войти </a>
        </div>
    </div>
</template>

<script>

import axios from 'axios';

export default {
    data() {

        return {
            user: {},
            isLogined: true,
        }
    },
    mounted() {
        let result = axios.get('/profile/getSelfInfo').then((Response) => {
            if (Response.data.hasError == false) {
                this.isLogined = true;
                this.$refs.avatarImage.src = "/" + Response.data.data.avatar_url;
                this.user = Response.data.data;
            }
            else {
                this.isLogined = false;
            }
        });
    },
    methods: {
        showMenu() {
            let headerMenu = this.$refs.headerMenu
            headerMenu.classList.add('header__nav--enabled')
            headerMenu.classList.remove('header__nav--disabled')
        },
        hideMenu() {
            let headerMenu = this.$refs.headerMenu
            headerMenu.classList.add('header__nav--disabled')
            headerMenu.classList.remove('header__nav--enabled')
        },
        goToProfile(){
            window.location.href = "/profile/" + this.user.id
        },
        logout(){
            axios.post('/logout').then(function(Response){
                window.location.href="/";
            }).catch(function(error){
                window.location.href = "/";
            });
        }
    }
};

</script>

<style scoped lang="scss">
.header {
    background-color: white;
    width: calc(100% - 28px * 2);
    display: flex;
    justify-content: space-between;
    padding-left: 28px;
    padding-right: 28px;
    padding-top: 10px;
    padding-bottom: 10px;
    position: fixed;
    overflow: hidden;
    top:0;

    &__nav--disabled {
        position: fixed;
        transform: translateX(calc(-100% - 400px));
        top: 0;
        transition-property: transform;
        transition-duration: 0.5s;
        display: flex;
        flex-direction: column;
        width: 400px;
        height: 100%;
        background-color: #EEE;
        position: fixed;

    }

    &__nav--enabled {
        position: fixed;
        top: 0;
        transform: translateX(-28px);
        transition-property: transform;
        transition-duration: 0.5s;
        display: flex;
        flex-direction: column;
        width: 400px;
        height: 100%;
        background-color: #EEE;
        padding-left: 28px;
        padding-right: 28px;
        padding-top: 10px;
        padding-bottom: 10px;

        gap: 10px;
    }

    &__left {
        display: flex;
        flex-direction: row;
        gap: 10px;
        align-items: center;
    }

    &__right {
        display: flex;
        flex-direction: row;
        gap: 10px;
        align-items: center;
    }

    &__avatar {
        object-fit: cover;
        width: 54px;
        height: 54px;
        border-radius: 50%;
        border: 1px solid #7a7a7a;
    }

    &__menu--button {
        width: 54px;
        height: 54px;
        color: #7a7a7a;
    }

    ;

    &__user--name {
        color: #7a7a7a;
    }
}
</style>