<template>

    <div class="user--card" @click="goToProfile">
        <img ref="userAvatar" class="user--card__avatar">

    </img>
        <h2 class="user-card__user--name">{{ user.name }}</h2>
        <h2 class="user-card__user--lastname">{{ user.lastname }}</h2>
    </div>

</template>

<script>
import axios from 'axios';


export default {
    props: {
        targetId: { 
            type: Number 
        },
    },
    data(){
        return{
            user: {}
        }
    },
    mounted() {
        let result = axios.get('/user/getUserInfoById',{
            params: {id: this.targetId}
        }).then((Response) => {

            let data = Response.data;

            if (data.hasError == false) {
                this.user = data.data;
                this.$refs.userAvatar.src = "/" + this.user.avatar_url;
            }
            else {
                this.isUserExist = false;
            }
        }).catch(function(error){
            console.log(error);
        });
    },
    methods:{
        goToProfile(){
            window.location.href = "profile/" + this.targetId
        }
    }
}
</script>

<style lang="scss" scoped>

.user--card{
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    padding: 10px;
    width: 200px;
    height: 300px;
    overflow: hidden;
    border: 1px solid black;
    border-radius: 10px;

    &__avatar{
        width: 100px;
        height: 100px;
        border-radius: 50%;
        object-fit: cover;
    }

    &:hover{
        background-color: #EEE;
    }
}
</style>