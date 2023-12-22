<template>
    <header class="pt-5">
        <div class="container-xl">
            <b-breadcrumb :items="items"></b-breadcrumb>
        </div>
    </header>
  
</template>

<style scoped>
.container-xl {
    margin-top: 60px;
    margin-bottom: -2rem;
}
</style>

<script>
  export default {
    name: 'my-breadcrumb',
    props: {
        title: {
            type: String,
            required: true
        }
    },
    data() {
        return {
            items: [
            {
                text: 'Home',
                href: '/'
            },
            {
                text: this.title,
                active: true
            }
            ]
        }
    }
  }
</script>