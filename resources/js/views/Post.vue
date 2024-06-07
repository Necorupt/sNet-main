<template>
    <HeaderCmp></HeaderCmp>

    <div class="post">
        <div class="post__content" v-html="post.text">

        </div>
    </div>
</template>

<script setup>

import HeaderCmp from "../components/HeaderCmp.vue"

</script>


<script>
import 'highlight.js/styles/github-dark.css';
import axios from "axios"
import hljs from 'highlight.js/lib/core';
import cpp from 'highlight.js/lib/languages/cpp.js';

export default {
    data() {

        return {
            user: {},
            isUserExist: true,
            post: {},
        }
    },
    mounted() {

        hljs.registerLanguage('c++', cpp);

        axios.get('/posts/get', {
            params: { id: this.$route.params.id }
        }).then((Response) => {
            let data = Response.data;
            console.log(data);
            if (data.hasError == false) {
                this.post = data.data;

                this.$nextTick(function(){
                    document.querySelectorAll('.ql-code-block').forEach(el => {
                        hljs.highlightElement(el);
                    })
                }
            );
    }
            else {

    }
}).catch (function (error) {
    console.log(error);
});
    },
}

</script>

<style lang="scss">
.post {
    padding-top: 200px;
    display: flex;
    flex-direction: row;
    justify-content: center;

    &__content {
        background-color: #EEEEEE;
        border-radius: 12px;
        padding: 12px;
        width: 80%;

        blockquote {
            text-wrap: pretty;
        }
    }
}

.ql-code-block-container {
    background-color: #0d1117;
    border-radius: 12px;
    color: white;
    padding-top: 24px;
    padding-left: 12px;
    padding-right: 12px;
    padding-bottom: 24px;


    .ql-code-block {
        tab-size: 4;
        -moz-tab-size: 4;
        -o-tab-size: 4;
        white-space: pre-wrap;
    }
}
</style>
