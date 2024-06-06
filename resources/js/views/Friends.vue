<script setup>
import HeaderCmp from "../components/HeaderCmp.vue";
import userCard from "../components/userCard.vue";
</script>

<template>
    <HeaderCmp></HeaderCmp>
    <div class="friends">
        <h1>Друзья</h1>
        <form class="friends__add" @submit.prevent="addFriend">
            <h2>Добавить по id</h2>
            <input class="input--field--ligh" name="target_id" placeholder="friendId" v-model="tartgetFriendId">
            <button class="button--s" type="submit">Подписаться</button>
        </form>

        <div class="friends__list">
            <userCard v-for="friend in friends" key="id" :targetId="friend.src_id" />
        </div>
    </div>
</template>

<script>

import axios from "axios";

export default {
    data() {
        return {
            tartgetFriendId: undefined,
            friends: {},
            selfInfo: {},
        }
    },
    mounted() {
        axios.get('/profile/getSelfInfo').then((Response) => {
            if (Response.data.hasError == false) {
                this.selfInfo = Response.data.data;
                axios.get("/user/getFriends", { params: { id: this.selfInfo.id } }).then(
                    (Response) => {
                        this.friends = Response.data;
                    }
                ).catch((error) => {
                    console.log(error);
                })
            }
            else {
                this.isLogined = false;
            }
        });

    },
    methods: {
        addFriend() {
            axios.post("/user/addFriend",
                { target_id: this.tartgetFriendId }
            ).then((Response) => {
                console.log(Response)
            });
        }
    }
}

</script>

<style scoped lang="scss">
.friends {
    margin-top: 200px;

    &__add {
        display: flex;
        flex-direction: row;
        gap: 20px;
        width: 100%;
    }
    
    &__list{
        display: flex;
        gap: 20px;
    }
}
</style>