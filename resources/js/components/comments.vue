<template>
    <div>
        <div class="row mb-4" v-if="authUser">
            <div class="col-1">
                <avatar :username="authUser.name" :size="30"></avatar>
            </div>
            <div class="col-11">
                <input v-model="newComment" type="text" class="input_comment"
                       placeholder="Add a public comment..." v-on:keyup.enter="addComment">
            </div>
        </div>

        <comment v-for="comment in comments.data" :key="comment.id" :comment="comment" :video="video"></comment>

        <div class="d-flex justify-content-center">
            <button v-if="comments.next_page_url" @click="fetchComments" type="button"
                    class="btn btn-success text-center">Load More
            </button>
            <p v-else>No more comment to show :)</p>
        </div>
    </div>
</template>

<script>
    import Avatar from 'vue-avatar';
    import Comment from './comment';

    export default {
        name: "comments",
        props: ['video'],
        components: {
            Avatar,
            Comment
        },
        mounted() {
            this.fetchComments();
        },
        data() {
            return {
                comments: {
                    data: []
                },
                authUser: __auth(),
                newComment: ''
            }
        },
        methods: {
            fetchComments() {
                const url = this.comments.next_page_url ? this.comments.next_page_url : `/videos/${this.video.id}/comments`
                axios.get(url)
                    .then(({data}) => {
                        this.comments = {
                            ...data,
                            data: [
                                ...this.comments.data,
                                ...data.data
                            ]
                        }
                    })
            },
            addComment() {
                if (!this.newComment) return

                axios.post(`/comments/${this.video.id}`, {
                    body: this.newComment
                }).then(({data}) => {
                        this.comments = {
                            ...this.comments,
                            data: [
                                data,
                                ...this.comments.data
                            ]
                        }

                        this.newComment = ''
                    })
            }
        }
    }
</script>

<style scoped>

</style>
