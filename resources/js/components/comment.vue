<template>
    <div class="row mt-4">
        <div class="col-1">
            <avatar :username="comment.user.name" :size="48"></avatar>
        </div>
        <div class="col-11">
            <div><b>{{ comment.user.name }}</b></div>
            <div>{{ comment.body }}</div>
            <div class="mt-2 mb-3 row">
                <div class="col-4">
                    <votes :default_votes="comment.votes" :entity_owner="comment.user.id"
                           :entity_id="comment.id"></votes>
                </div>
                <div class="col-2" v-if="authUser">
                    <a @click="showReplyForm = !showReplyForm" :class="{'text-danger' : showReplyForm}" style="color:#606060; cursor: pointer">
                        {{ showReplyForm ? 'Cancel' : 'Add Reply' }}
                    </a>
                </div>
            </div>
            <div class="row mb-4" v-if="showReplyForm">
                <div class="col-1" v-if="authUser">
                    <avatar :username="authUser.name" :size="30"></avatar>
                </div>
                <div class="col-11">
                    <input v-model="newReply" v-if="authUser" v-on:keyup.enter="addReply" type="text" class="input_comment"
                               placeholder="Add a public reply...">
                </div>
            </div>

            <replies ref="replies" :comment="comment"></replies>

        </div>
    </div>
</template>

<script>
    import Avatar from 'vue-avatar';
    import replies from "./replies";

    export default {
        name: "comment",
        props: {
            comment: {
                required: true,
                default: () => ({})
            },
            video: {
                required: true,
                default: () => ({})
            }
        },
        components: {
            Avatar,
            replies
        },
        data() {
            return {
                authUser: __auth(),
                showReplyForm: false,
                newReply:''
            }
        },
        methods:{
            addReply(){
                if (!this.newReply) return

                axios.post(`/comments/${this.video.id}`, {
                    body: this.newReply,
                    comment_id: this.comment.id
                }).then(({data}) => {

                    this.$refs.replies.addReply(data)

                    this.newReply = ''
                })
            }
        }
    }
</script>

<style scoped>

</style>
