<template>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" />
    <div class="create-post">
        <h1>
            CreatePost
        </h1>

        <input type="text" placeholder="title" v-model="createPostInfo.title">
        <div class="create-post__editor" ref="PostEditor">

        </div>


        <button class="button--s" @click="savePost">
            Создать
        </button>


        <div class="create-post__info">

        </div>
    </div>
</template>

<script>

import Quill from 'quill';
import "quill/dist/quill.core.css";

export default {
    data() {
        return {
            createPostInfo: {
                title: "",
                text: ""
            },
            configuration: {
                debug: 'info',
                modules: {
                    toolbar: [
                        ['link', 'image', 'video', 'formula'],
                        ['bold', 'italic', 'underline', 'strike'],
                        ['blockquote', 'code-block'],
                        [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                        [{ 'size': ['small', false, 'large', 'huge'] }],
                    ],
                },
                placeholder: 'Напишите о чем нибудь',
                theme: 'snow'
            },
            editor: null,
        }
    },
    mounted() {
       this.editor = new Quill(this.$refs.PostEditor, this.configuration);
    },
    methods: {
        savePost() {

            this.createPostInfo.text = this.editor.root.innerHTML;
            axios.post("/posts/create", this.createPostInfo).then((Response) => {

                if (Response.data.hasError == false) {
                    this.posts.push(this.createPostInfo);
                    this.createPostInfo.text = this.createPostInfo.title = "";
                }
            });


        }
    }
}

</script>

<style lang="scss">
.create-post {

    display: flex;
    flex-direction: column;
    padding: 16px;

    &__editor {
        width: 100%;
        height: 100vh;

    }
}
</style>
