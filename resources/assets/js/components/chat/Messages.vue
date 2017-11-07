<template>
	<div class="chat-messages" ref="messages">
		<chat-message v-for="message in messages" :key="message.id" :message="message"></chat-message>
	</div>
</template>

<script>
import Bus from '../../bus'

export default {

	name: 'Messages',

	data () {
		return {
			messages : []
		}
	},
	mounted(){
		axios.get('/chat/messages').then((response)=>{
			this.messages = response.data;
		});
		Bus.$on('messages.added', (message)=>{
			this.messages.unshift(message);
			if (message.selfOwned) {
				this.$refs.messages.scrollTop = 0
			}
		})
		.$on('messages.removed', (message) => {
			this.removeMessage(message.id);
		})
	},

	methods: {
		removeMessage (id){
			this.messages = this.messages.filter((message) => {
				return message.id !== id;
			})
		}
	},
}
</script>

<style lang="scss" >
.chat{
	&-messages{
		height:400px;
		mex-height:400px;
		overflow-y:scroll;
	}
}
</style>