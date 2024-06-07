<template>

    <div class="post">
        <h2>{{ this.title }}</h2>
        <div class="post__bottom">
            <h5>{{ this.shortText }}</h5>
            <div class="post__info">
                <div>
                    <h5>likes</h5>
                    <h5>{{ this.likes }}</h5>
                </div>
                <div>
                    <h5>likes</h5>
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
        comments:null
    }
}

</script>

<style>
.post {
    display: flex;
    flex-direction: column;
}
</style>
