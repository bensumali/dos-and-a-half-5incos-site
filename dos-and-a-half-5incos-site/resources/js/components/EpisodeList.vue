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
                                    Screen Shot 2017-07-29 at 15.54.25.png
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="field">
                        <vue-cropper
                            ref="cropper"
                            :src="photo"
                            alt="Source Image"
                            :cropmove="cropImage"
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
    export default {
        components: {
          VueCropper
        },
        data: function() {
            return {
                cropImage: "",
                photo: "",
                showModal: false
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
                this.photo = URL.createObjectURL(event.target.files[0]);
            }
        },
        name: "EpisodeList"
    }
</script>

<style scoped>

</style>
