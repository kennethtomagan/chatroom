<template>
	<div class="users">
		<div class="users-header">{{ users.length }} {{ pluralize('user', users.length) }} online</div>
		<div class="users-user" v-for="user in users"> 
			<a href="#">{{ user.name }}</a>
		</div>
	</div>
</template>

<script>
import pluralize from 'pluralize'
import Bus from '../../bus'
export default {

  name: 'Users',

  data () {
    return {
    	users: []
    }
  },
  methods:{
  	pluralize: pluralize
  },
  mounted(){
  	Bus.$on('users.here', (users) => {
  		this.users = users
  	})
  	.$on('users.joined', (user) =>{
  		this.users.unshift(user)

  	})
  	.$on('users.left', (user) =>{
  		this.users = this.users.filter((u)=>{
  			return u.id !== user.id
  		})
  	})
  }
}
</script>

<style lang="scss" >
	.users {
		background-color: #fff;
		border-top: 1px solid #d3e0e9;
		border-radius: 3px;
		&-header{
			padding:15px;
			font-weight:800;
			margin:0;
		}
		&-user{
			padding: 0 15px;
			&:last-child{
				padding-bottom: 15px;
			}
		}
	}
</style>