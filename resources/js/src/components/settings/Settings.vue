<template>
    <section class="py-5 my-5">
        <div class="container-xl">
            <div class="row gx-2">
                <div class="col-auto"><img class="rounded-circle" :src="user.candidate_profile_picture" alt="profile" width="50px" height="50px" /></div>
                <div class="col d-inline justify-content-xxl-start align-items-xxl-start" style="margin-top: 5px;">
                    <h5 style="margin-bottom: -2px;">{{ user.candidate_name }} ({{ user.candidate_username }})</h5>
                    <p class="text-muted" style="font-size: 12px;">Your personal account</p>
                </div>
            </div>
        </div>
        <!-- <div class="container-xl">
            <hr />
        </div> -->
        <div class="container-xl">
            <div class="row">
                <div class="col-3">
                    <Sidebar navbar-active="settings" />
                </div>
                <div class="col-lg">
                    <h3>Settings</h3>
                    <hr />
                    <form>
                        <div>
                            <label class="form-label" for="full_name">Appearance</label>
                            
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>
.media-container {
	position: relative;
	display: inline-block;
	margin: auto;
	border-radius: 50%;
	overflow: hidden;
	width: 150px;
	height: 150px;
	vertical-align: middle;
    border: 1px solid #ccc;
}
.media-overlay {
	position: absolute;
    display: none;
	left: 0;
	top: 0;
	width: 100%;
	height: 100%;
	background-color: rgba(180, 180, 180, 0.6);
}

#media-input {
	display: none;
	width: 150px;
    height: 150px;
	line-height: 150px;
	opacity: 0;
	position: relative;
	z-index: 9;
}
.media-icon {
	display: block;
	color: #ffffff;
	font-size: 2em;
	height: 150px;
	/* line-height: 200px; */
    margin-left: 38%;
	position: absolute;
    top: 0;
	z-index: 0;
    width: 20%;
	text-align: center;
}
.media-object {}
	.img-object {
		border-radius: 50%;
		width: 150px;
		height: 150px;
		display: block;
	}

.media-control {
	margin-top: 30px;
}
.edit-profile {}
.save-profile {}

</style>

<script>
    import Sidebar from './Mysidebar.vue'
    export default {
        name: "settings",
        components: { Sidebar },
        data() {
            return {
                timer: 5,
                user: null,
                interval: null
            }
        },
        created() {
            this.getUser()
        },
        methods: {
            async getUser() {
                let user = this.$store.state.user
                this.user = user
            },

            enableEdit() {
                var mediaInput = document.getElementById('media-input');
                var mediaContainer = document.getElementsByClassName('media-container')[0];
                var mediaObject = document.getElementsByClassName('media-object')[0]
                var mediaOverlay = document.getElementsByClassName('media-overlay')[0]

                // media container hover

                mediaOverlay.style.display = 'block';
                mediaInput.style.display = 'block';
            },

            disableEdit() {
                var mediaInput = document.getElementById('media-input');
                var mediaContainer = document.getElementsByClassName('media-container')[0];
                var mediaObject = document.getElementsByClassName('media-object')[0]
                var mediaOverlay = document.getElementsByClassName('media-overlay')[0]

                // media container hover

                mediaOverlay.style.display = 'none';
                mediaInput.style.display = 'none';
            },

            handleFileChange(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        console.log(e.target.result);
                        this.user.candidate_profile_picture = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
                // Reset the file input to allow selecting the same file again
                this.$refs.mediaInput.value = '';
            },
        }
    }
</script>