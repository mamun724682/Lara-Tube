import numeral from 'numeral';

Vue.component('subscribe-button', {
    props: {
        subscriptions:{
            type: Array,
            required: true,
            default: () => []
        },
        channel:{
            type: Object,
            required: true,
            default: () => ({})
        }
    },
    computed:{
        subscribed(){
            if (! __auth() || this.channel.user_id == __auth().id) return false

            return !!this.subscription
        },
        owner(){
            if (__auth() && this.channel.user_id == __auth().id) return true

            return false
        },
        count(){
            return numeral(this.subscriptions.length).format('0a')
        },
        subscription(){
            if (! __auth()) return null

            return this.subscriptions.find(subscription => subscription.user_id == __auth().id)
        }
    },
    methods: {
        toggleSubscription() {
            if (!__auth()) {
                toastr.options =
                    {
                        "closeButton": true,
                        "progressBar": true
                    }
                toastr.error("Your are not logged in!");
                return;
            }

            if (this.owner){
                toastr.options =
                    {
                        "closeButton": true,
                        "progressBar": true
                    }
                toastr.error("You can't subscribe to own channel!");
                return;
            }

            if(this.subscribed){
                axios.delete(`/channels/${this.channel.id}/subscription/${this.subscription.id}`);
            }else {
                axios.post(`/channels/${this.channel.id}/subscription`);
            }
        }
    }
});
