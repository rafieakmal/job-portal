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
                    <Sidebar navbar-active="profile" />
                </div>
                <div class="col-lg">
                    <h3>Profile</h3>
                    <hr />
                    <modal height="auto" :scrollable="true" :adaptive="true" name="my-first-modal">
                        <!-- <div class="cropper-wrapper">
                            
                        </div> -->
                            <cropper
                                class="cropper"
                                :src="change.profile_picture"
                                stencil-component="circle-stencil"
                                :stencil-props="{
                                    handlers: {},
                                    aspectRatio: 1/1,
                                    movable: false,
		                            resizable: false,
                                }"
                                ref="cropper"
                                :resize-image="{
                                    adjustStencil: false
                                }"
                                image-restriction="stencil"
                            ></cropper>
                            <div class="text-center">
                                <button class="btn btn-primary fw-lighter shadow" type="button" style="width: 100%;" @click="crop">Crop</button>
                            </div>
                    </modal>
                    <form>
                        
                        
                        <div class="mb-3 mt-3">
                            <div class="media-container" @mouseover="enableEdit" @mouseout="disableEdit">
                            <span class="media-overlay">
                                <input type="file" id="media-input" ref="mediaInput" @change="handleFileChange" accept="image/*">
                                <!-- edit icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-pen-fill media-icon" viewBox="0 0 16 16">
                                <path d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001"/>
                                </svg>
                            </span>
                            <figure class="media-object">
                                <img class="img-object" :src="user.candidate_profile_picture" alt="Profile Picture">
                            </figure>
                            </div>
                        </div>
                        <div>
                            <label class="form-label" for="full_name">Name</label>
                            <input class="form-control form-control-sm" type="text" placeholder="Name" id="full_name" v-model="user.candidate_name" name="full_name"/></div>
                        <div>
                            <label class="form-label mt-2" for="user_name">Username</label>
                            <input class="form-control form-control-sm" type="text" placeholder="Name" id="user_name" name="user_name" v-model="user.candidate_username"/>
                        </div>
                        <div>
                            <label class="form-label mt-2" for="email">Email</label>
                            <input class="form-control form-control-sm" type="email" placeholder="Email" id="email" name="email" v-model="user.candidate_email"/>
                        </div>
                        <div>
                            <label class="form-label mt-2">Gender</label>
                            <v-select v-model="user.candidate_gender" :options="options" placeholder="Select your gender"></v-select>
                        </div>
                        <div v-if="user.candidate_phone">
                            <label class="form-label mt-2" for="phone">Phone</label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text" style="border-top-left-radius: 4px;border-bottom-left-radius: 4px;">+62</span>
                                <input class="form-control" type="tel" id="phone" name="phone" placeholder="Phone Number" />
                                <button class="btn btn-primary" type="button" style="border-top-right-radius: 4px;border-bottom-right-radius: 4px;">Verify</button>
                            </div>
                        </div>
                        <div v-else>
                            <!--  -->
                        </div>
                        <div class="text-center">
                            <button v-if="isDataChanged" class="btn btn-primary shadow myform" type="submit" style="width: 100%; margin-top: 20px;">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</template>

<style scoped>


.form-control {
    border-radius: 4px;
    border-color: #ccc;
}

.shadow.myform {
    border-radius: 4px;
}

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

.cropper {
    width: 100%;
    height: 400px;
}

.cropper-wrapper {
	overflow: hidden;
	position: relative;
	background: black;
}
.cropper-background {
	background: none;
}
.image-background {
	position: absolute;
	width: calc(100% + 20px);
	height: calc(100% + 20px);
	left: -10px;
	top: -10px;
	background-size: cover;
	background-position: 50%;
	filter: blur(5px);
}

</style>

<script>
    import Sidebar from './Mysidebar.vue'
    import timesago from 'timesago'
    import { CircleStencil, Cropper, Preview } from 'vue-advanced-cropper'
    import 'vue-advanced-cropper/dist/style.css';
    export default {
        name: "profile",
        components: { Sidebar, Cropper, CircleStencil, Preview},
        // Data for user
        data() {
            return {
                timer: 5,
                user: null,
                change: {
                    profile_picture: null
                },
                items: null,
                selected: null,
                options: ['He/Him', 'She/Her', 'They/Them'],
                interval: null,
                coordinates: {
                    width: 0,
                    height: 0,
                    left: 0,
                    top: 0,
                },
                image: null,
                isBusy: true,
                isDataChanged: false,
                isLoaded: false,
            }
        },
        // Watch for changes in user data
        watch: {
            // whenever user changes, this function will run
            user: {
                handler: function (val, oldVal) {
                    if (this.isBusy || !this.isLoaded) {
                        this.isLoaded = true
                    } else {
                        this.isDataChanged = true
                    }
                },
                deep: true
            },

            // force eager watch
            immediate: true
        },
        // Get user data from store after component is created
        created() {
            this.getUser()
        },
        methods: {
            // Get user data from store
            async getUser() {
                let user = this.$store.state.user
                this.items = [
                    { 
                        data: 'Last login',
                        time: timesago(user.candidate_last_login)
                    },
                ]
                this.user = user
                this.isBusy = false
            },

            // Enable edit profile picture
            enableEdit() {
                var mediaInput = document.getElementById('media-input');
                var mediaContainer = document.getElementsByClassName('media-container')[0];
                var mediaObject = document.getElementsByClassName('media-object')[0]
                var mediaOverlay = document.getElementsByClassName('media-overlay')[0]

                // media container hover

                mediaOverlay.style.display = 'block';
                mediaInput.style.display = 'block';
            },

            // Disable edit profile picture
            disableEdit() {
                var mediaInput = document.getElementById('media-input');
                var mediaContainer = document.getElementsByClassName('media-container')[0];
                var mediaObject = document.getElementsByClassName('media-object')[0]
                var mediaOverlay = document.getElementsByClassName('media-overlay')[0]

                // media container hover

                mediaOverlay.style.display = 'none';
                mediaInput.style.display = 'none';
            },

            // Handle image coordinates
            onChange({ coordinates, image }) {
                this.result = {
                    coordinates,
                    image
                };
            },

            // Handle image crop
            crop() {
                const { coordinates, canvas, } = this.$refs.cropper.getResult();
                this.coordinates = coordinates;
                // You able to do different manipulations at a canvas
                // but there we just get a cropped image, that can be used 
                // as src for <img/> to preview result
                this.user.candidate_profile_picture = canvas.toDataURL();
                this.$modal.hide('my-first-modal');
		    },

            // Handle file change
            async handleFileChange(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = (e) => {
                        this.change.profile_picture = e.target.result;
                    };
                    reader.readAsDataURL(file);

                    this.$nextTick(() => {
                        this.$modal.show('my-first-modal');
                    })
                }
                // Reset the file input to allow selecting the same file again
                this.$refs.mediaInput.value = '';
            },
        }
    }
</script>