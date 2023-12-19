<template>
  <div>
    <router-view @loggedIn="setUser"></router-view>
  </div>
</template>

<script>
export default {
  name: 'app',
  data() {
    return {
      user: null,
      isLoggedIn: false
    }
  },
  mounted() {
    this.setUser()
  },
  
  methods: {
    setUser() {
      this.user = JSON.parse(localStorage.getItem('user'))
      this.isLoggedIn = localStorage.getItem('token') != null

    },
    logout() {
      localStorage.removeItem('token')
      localStorage.removeItem('user')
      this.setUser()

      this.$router.push('/login')
    }
  }
}
</script>
 