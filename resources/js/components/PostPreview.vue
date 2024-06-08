<template>

    <div class="post" @click="onClick">
        <h2>{{ this.title }}</h2>
        <div class="post__bottom">
            <h5>{{ this.shortText }}</h5>
            <div class="post__info">
                <div class="post__info-item">
                    <h5>likes</h5>
                    <h5>{{ this.likes }}</h5>
                </div>
                <div class="post__info-item">
                    <h5>comments</h5>
                    <h5>{{ this.comments }}</h5>
                </div>
            </div>
        </div>
    </div>

</template>

<script>

export default {
    props: {
        title:null,
        shortText:null,
        likes:null,
        comments:null,
        link:null
    },
    methods:{
        onClick(){
            document.location.href=this.link;
        }
    }
}

</script>

<style scoped lang="scss">
.post {
    display: flex;
    flex-direction: column;
    width: 100%;
    justify-content: space-between;

    &__info{
        display: flex;
        flex-direction: row;
        width: 100%;
        justify-content: space-between;
        &-item{
            display: flex;
            flex-direction: row;
            gap: 20px;
        }
    }
}
</style>
