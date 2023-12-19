<template>
    <section>
        <div class="container">
            <div class="row">
                <div class="col">
                    <hr class="custom-hr"/>
                </div>
                <div class="col text-end">
                    <h2>Share This Vote</h2>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <figure>
                        <blockquote class="blockquote">
                            <p class="mb-0">Here's your magical ballot entrance!</p>
                        </blockquote>
                        <figcaption class="blockquote-footer">Eligere</figcaption>
                    </figure>
                </div>
                <div class="col-md-6 text-end">
                    <button class="btn custom btn-outline-dark font-monospace" type="button" v-clipboard:copy="link" v-clipboard:success="onCopy">Copy Link Here 
                        <i class="far fa-copy"></i>
                    </button>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>
.accordion-item {
    border-radius: 1px;
    border-width: 1px;
    border-color: var(--bs-gray);
}

.row {
    margin-top: 20px;
}

.custom-hr {
    border-radius: 8px;
    border-width: 5px;
    border-color: var(--bs-blue);
}
.btn.custom {
    width: 259.9875px;
}
.toast:not(.show) {
   display: block;
}

</style>

<script>
    export default {
        name: "vote-accordion",
        props: {
            desc: String,
        },
        data() {
            return {
                message: '',
                link: ''
            };
        },
        mounted() {
            this.getLink()
        },
        methods: {
            getLink() {
                this.message = this.$route.params.slug
                this.link = 'http://localhost:8000/vote/' + this.$route.params.slug + '/'
            },
            onCopy(e) {
                this.openNotification(null)
            },
            openNotification(duration) {
                const notification = this.$vs.notification({
                    duration,
                    color: 'dark',
                    progress: 'auto',
                    title: 'Success to copy link',
                })
            },
            onError(e) {
                alert('Failed to copy text')
            }
        }
    }
</script>