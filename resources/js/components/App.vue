<template>
    <div v-if="article != null" class="alert alert-primary" role="alert">
        Добавлена новая статья <a :href="`/article/${article.id}`">{{  article.name }}</a>
    </div>
</template>


<script>

export default {
    data() { return { article: null } },
    created() {
        window.Echo.channel('test').listen('NewArticleEvent', (article) => {
            console.log(article);
            this.article = article.article;
            // alert('Добавлена новая статья!');
        })
    }
}

</script>

<style></style>