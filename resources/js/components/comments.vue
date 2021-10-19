<template>
<div>
    <div class="row mb-4" v-if="authUser">
        <div class="col-1">
            <avatar :username="authUser.name" :size="30"></avatar>
        </div>
        <div class="col-11">
            <form>
                <input type="text" name="comment" class="input_comment"
                       placeholder="Add a public comment...">
            </form>
        </div>
    </div>
    <div class="row mt-4" v-for="comment in comments.data" :key="comment.id">
        <div class="col-1">
            <avatar :username="comment.user.name" :size="48"></avatar>
        </div>
        <div class="col-11">
            <div><b>{{ comment.user.name }}</b></div>
            <div>{{ comment.body }}</div>
            <div class="row mt-2 mb-3">
                <div class="col-1">
                    <a style="color:#606060; cursor: pointer" title="I like this">
                        <i class="fa fa-thumbs-up w-auto" style="font-size: 15px"></i>
                        5
                    </a>
                </div>
                <div class="col-1">
                    <a style="color:#606060; cursor: pointer" title="I dislike this">
                        <i class="fa fa-thumbs-down w-auto" style="font-size: 15px"></i>
                        45
                    </a>
                </div>
                <div class="col-1" v-if="authUser">
                    <a @click="showReplyForm" style="color:#606060; cursor: pointer" title="I dislike this">
                        Reply
                    </a>
                </div>
            </div>
            <div class="row mb-4" v-if="authUser" v-show="showReply">
                <div class="col-1">
                    <avatar :username="authUser.name" :size="30"></avatar>
                </div>
                <div class="col-11">
                    <form>
                        <input type="text" name="comment" class="input_comment"
                               placeholder="Add a public reply...">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        <button  v-if="comments.next_page_url" @click="fetchComments" type="button" class="btn btn-success text-center">Load More</button>
        <p v-else>No more comment to show :)</p>
    </div>
</div>
</template>

<script>
    import Avatar from 'vue-avatar';

    export default {
        name: "comments",
        props:['video'],
        components: {
            Avatar
        },
        mounted() {
            this.fetchComments();
        },
        data(){
            return {
                comments: {
                    data: []
                },
                authUser: __auth(),
                showReply: false
            }
        },
        methods: {
            fetchComments(){
                const url = this.comments.next_page_url ? this.comments.next_page_url : `/videos/${this.video.id}/comments`
                axios.get(url)
                    .then(({ data }) => {
                        this.comments = {
                            ...data,
                            data:[
                                ...this.comments.data,
                                ...data.data
                            ]
                        }
                    })
            },
            showReplyForm(){
                this.showReply = !this.showReply
            }
        }
    }
</script>

<style scoped>

</style>
