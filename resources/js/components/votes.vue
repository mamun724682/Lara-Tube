<template>
    <div class="row">
        <div class="col-3 ">
            <a @click="vote('up')" style="color:#606060; cursor: pointer" title="I like this">
                <i class="fa fa-thumbs-up w-auto" :class="{ 'text-primary' : upvoted }" style="font-size: 15px"></i>
                {{ upvotes_count }}
            </a>
        </div>
        <div class="col-3">
            <a @click="vote('down')" style="color:#606060; cursor: pointer" title="I dislike this">
                <i class="fa fa-thumbs-down w-auto" :class="{ 'text-primary' : downvoted }" style="font-size: 15px"></i>
                {{ downvotes_count }}
            </a>
        </div>
    </div>
</template>

<script>
    import numeral from 'numeral';

    export default {
        name: "votes",
        props: {
            default_votes:{
                required: true,
                default: () => []
            },
            entity_owner:{
                required: true,
                default: ''
            },
            entity_id:{
                required: true,
                default: ''
            }
        },
        data(){
            return {
                votes: this.default_votes
            }
        },
        computed: {
            upvotes(){
                return this.votes.filter(vote => vote.type == 'up')
            },
            downvotes(){
                return this.votes.filter(vote => vote.type == 'down')
            },
            upvotes_count(){
                return numeral(this.upvotes.length).format('0a')
            },
            downvotes_count(){
                return numeral(this.downvotes.length).format('0a')
            },
            upvoted(){
                if (! __auth()) return false

                return !!this.upvotes.find(v => v.user_id == __auth().id)
            },
            downvoted(){
                if (! __auth()) return false

                return !!this.downvotes.find(v => v.user_id == __auth().id)
            }
        },
        methods: {
            vote(type){
                if(! __auth()){
                    toastr.options =
                        {
                            "closeButton": true,
                            "progressBar": true
                        }
                    toastr.error("Please login to vote!");
                    return;
                }
                if(__auth().id == this.entity_owner){
                    toastr.options =
                        {
                            "closeButton": true,
                            "progressBar": true
                        }
                    toastr.error("You can't vote this item!");
                    return;
                }

                if(type == 'up' && this.upvoted) return;

                if(type == 'down' && this.downvoted) return;

                axios.post(`/vote/${this.entity_id}/${type}`)
                .then(({ data }) => {
                    if(this.upvoted || this.downvoted){
                        this.votes = this.votes.map(vote => {
                            if (vote.user_id == __auth().id){
                                return data
                            }

                            return vote
                        })
                    }else {
                        this.votes = [
                            ...this.votes,
                            data
                        ]
                    }
                })
            }
        }
    }
</script>

<style scoped>

</style>
