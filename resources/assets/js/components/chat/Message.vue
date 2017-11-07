<template>
	<div class="chat-message" :class="{'chat-message-own': message.selfOwned}">
			<strong class="chat-message-user">{{ message.user.name }}</strong>
			<strong class="chat-message-timestamp">{{ message.created_at }}</strong>
			<p class="chat-message-body">{{ message.body }}</p>
	</div>
</template>

<script>
export default {

	name: 'Message',
	props: ['message'],
	data () {
		return {

		}
	}
}
</script>

<style lang="scss" >
	.chat{
		&-message{
			padding: 15px;
			border-bottom: 1px solid #eee;
			&-own{
				background-color: #f0f0f0;
			}
			&-user{
				font-weight:800;
			}
			&-timestamp{
				color:#aaa;
			}
			&-body {
				margin-bottom:0;
				white-space:pre-wrap;
			}
		}
	}
</style>