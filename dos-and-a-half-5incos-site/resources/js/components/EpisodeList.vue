<template>
    <div id="episode-list">
        <div class="modal" :class="{'is-active': showModal}">
            <div @click="hideModal()" class="modal-background"></div>
            <div class="modal-card">
                <header class="modal-card-head">
                    <p class="modal-card-title">Add new episode</p>
                    <button class="delete" aria-label="close"></button>
                </header>
                <section class="modal-card-body">
                    <div class="field">
                        <label class="label">Title</label>
                        <div class="control">
                            <input class="input" type="text" placeholder="Show me the title">
                        </div>
                    </div>
                    <div class="field">
                        <label class="label">Photo</label>
                        <div class="file has-name is-fullwidth">
                            <label class="file-label">
                                <input class="file-input" type="file" name="resume" @change="processFile($event)">
                                <span class="file-cta">
                                    <span class="file-icon">
                                        <i class="fas fa-upload"></i>
                                    </span>
                                    <span class="file-label">
                                        Choose a file…
                                    </span>
                                </span>
                                <span class="file-name">
                                    <span v-if="uploadedFile">{{ uploadedFile.name }}</span>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="field">
                        <vue-cropper
                            v-show="uploadedFile"
                            ref="cropper"
                            :aspect-ratio="1 / 1"
                        >
                        </vue-cropper>
                    </div>
                </section>
                <footer class="modal-card-foot">
                    <button class="button is-success">Save changes</button>
                    <button class="button">Cancel</button>
                </footer>
            </div>
        </div>
        <button id="display-modal-button" @click="displayModal()">CLICK ME</button>
    </div>
</template>

<script>
    import VueCropper from 'vue-cropperjs';
    import 'cropperjs/dist/cropper.css';
    import axios from 'axios';
    export default {
        components: {
          VueCropper
        },
        data: function() {
            return {
                cropImage: "",
                photo: "",
                showModal: false,
                uploadedFile: null,
                test: process.env.VUE_APP_TITLE
            }
        },
        methods: {
            hideModal: function() {
                if(this.showModal)
                    this.showModal = false;
            },
            displayModal: function() {
              this.showModal = true;
            },
            processFile: function(event) {
                const file = event.target.files[0];
                if (typeof FileReader === 'function') {
                    const reader = new FileReader();
                    reader.onload = (event) => {
                        this.imgSrc = event.target.result;
                        // rebuild cropperjs with the updated source
                        this.$refs.cropper.replace(event.target.result);
                    };
                    reader.readAsDataURL(file);
                    this.uploadedFile = file;
                } else {
                    alert('Sorry, FileReader API not supported');
                }
            }
        },
        mounted: function() {
            axios
                .get('https://api.themoviedb.org/3/movie/550?api_key=1c2b604f70ca7a756893b4d6c8eccc58')
                .then(response => (console.log(response)))
        },
        name: "EpisodeList"
    }
</script>

<style scoped>

</style>
