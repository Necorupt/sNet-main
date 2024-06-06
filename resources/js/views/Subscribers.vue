<script setup>
import HeaderCmp from "../components/HeaderCmp.vue"
import userCard from "../components/userCard.vue";
</script>

<template>
    <HeaderCmp></HeaderCmp>
    <div class="subscribers">
        <h1>Подписчики</h1>
        <form class="subscribers__add" @submit.prevent="addFriend">
            <h2>Добавить по id</h2>
            <input class="input--field--ligh" name="target_id" placeholder="friendId" v-model="tartgetFriendId">
            <button class="button--s" type="submit">Подписаться</button>
        </form>

        <div class="subscribers__list">
            <userCard v-for="sub in subscribers" key="id" :targetId="sub.src_id" />
        </div>
    </div>
</template>

<script>

import axios from "axios";

export default {
    data() {
        return {
            tartgetFriendId: undefined,
            subscribers: undefined,
        }
    },
    mounted() {
        axios.get("/user/getSelfSubscribers",
        ).then((Response) => {
            console.log(Response);
            this.subscribers = Response.data.data;
        });
    },
    methods: {
        addFriend() {

        }
    }
}

</script>

<style scoped lang="scss">
.subscribers {
    display: flex;
    flex-direction: column;
    gap: 20px;
    margin-top: 200px;
    padding: 28px;

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