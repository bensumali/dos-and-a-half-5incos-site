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
                            <input v-model="episode_new.title" class="input" type="text" placeholder="Show me the title">
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
                    <div class="field">
                        <label class="label">Movies</label>
                        <div class="control">
                            <v-select
                                @search="searchTMDB"
                                @input="selectMovie"
                                :options="search_results_movies"
                                label="title"
                                :placeholder="'Search for movies'"
                                :inputId="'movie-search'"
                            >
                                <template v-slot:option="movie">
                                    <span class="media-poster">
                                        <img v-if="movie.poster_path" :src="'http://image.tmdb.org/t/p/w185/' + movie.poster_path"  />
                                        <img v-else src="img/poster-placeholder.png"/>
                                    </span>
                                    <div class="media-info">
                                        <div class="media-title">
                                            {{ movie.title }}
                                        </div>
                                        <div class="media-year">
                                            {{ movie.release_date | moment("YYYY") }}
                                        </div>
                                        <div class="media-other">
                                            {{ movie.overview }}
                                        </div>
                                    </div>
                                </template>
                            </v-select>
                        </div>
                        <div id="movie-list">

                        </div>
                    </div>
                </section>
                <footer class="modal-card-foot">
                    <button @click="addEpisode()" class="button is-success">Add</button>
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
    import vSelect from 'vue-select'
    import 'vue-select/dist/vue-select.css';
    import _ from 'lodash';
    import Episode from "../models/Episode";

    export default {
        components: {
          VueCropper, vSelect
        },
        data: function() {
            return {
                cropImage: "",
                movie_search: "fight",
                episode_new: new Episode(),
                photo: "",
                search_results_movies: [],
                showModal: false,
                uploadedFile: null,
                test: process.env.VUE_APP_TITLE
            }
        },
        methods: {
            addEpisode: function() {
                this.$refs.cropper.getCroppedCanvas().toBlob((blob) => {
                    const mypostparameters= new FormData();
                    mypostparameters.append('image', blob, this.episode_new.image.name);
                    axios.post('/api/files/', mypostparameters);
                });
                // this.$store.dispatch('STORE_EPISODE', this.episode_new).then(function(d) {
                //
                // });
            },
            debounce: function(fn, delay) {
                  return _.debounce(fn, delay);
            },
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
                    this.episode_new.image = file;
                } else {
                    alert('Sorry, FileReader API not supported');
                }
            },
            searchTMDB: _.debounce(function(search, loading) {
                let query = search;
                if(query) {
                    axios
                        .get('https://api.themoviedb.org/3/search/movie?api_key='+ process.env.MIX_TMDB_API_KEY +'&query='+ encodeURI(query) +'&page=1')
                        .then(response => (this.search_results_movies = response.data.results));
                }
            }, 200),
            selectMovie: function(val) {

            }
        },
        mounted: function() {

        },
        name: "EpisodeList"
    }
</script>

<style scoped>

</style>
