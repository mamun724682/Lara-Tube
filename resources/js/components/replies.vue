<template>
    <div>
        <div class="row mb-4">
            <div class="col-1" v-if="authUser">
                <avatar :username="authUser.name" :size="30"></avatar>
            </div>
            <div class="col-11">
                <form>
                    <input v-if="authUser" type="text" name="comment" class="input_comment"
                           placeholder="Add a public reply...">
                </form>
                <div v-for="reply in replies.data" class="row my-2">
                    <div class="col-1">
                        <avatar :username="reply.user.name" :size="30"></avatar>
                    </div>
                    <div class="col-11">
                        <div><b>{{ reply.user.name }}</b></div>
                        <div>{{ reply.body }}</div>
                        <div class="mt-2 mb-3">
                            <votes :default_votes="reply.votes" :entity_owner="reply.user.id" :entity_id="reply.id"></votes>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center my-3">
            <button v-if="comment.replyCount > 0 && replies.next_page_url" @click="fetchReplies" type="button" class="btn btn-success text-center btn-sm">Load More</button>
        </div>
    </div>
</template>

<script>
    import Avatar from 'vue-avatar';

    export default {
        name: "replies",
        props: ['comment'],
        components: {
            Avatar
        },
        data(){
            return {
                replies: {
                    data: [],
                    next_page_url: `/comments/${this.comment.id}/replies`
                },
                authUser: __auth()
            }
        },
        methods:{
            fetchReplies(){
                axios.get(this.replies.next_page_url)
                    .then(({ data }) => {
                        this.replies = {
                            ...data,
                            data: [
                                ...this.replies.data,
                                ...data.data
                            ]
                        }
                    })
            }
        }
    }
</script>

<style scoped>

</style>
