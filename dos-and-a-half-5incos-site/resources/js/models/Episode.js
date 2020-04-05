import { Model } from '@vuex-orm/core'
import Movie from "./Movie";
import EpisodeMovie from "./EpisodeMovie";
import File from './File';

export default class Episode extends Model {
    // This is the name used as module name of the Vuex Store.
    static entity = 'episodes';
    static primaryKey = "id";

    // List of all fields (schema) of the post model. `this.attr` is used
    // for the generic field type. The argument is the default value.
    static fields () {
        return {
            id: this.uid(),
            title: this.attr(''),
            image: this.attr(''),
            photo_file_id: this.attr(''),
            date_recorded: this.attr(''),
            date_published: this.attr(''),
            created_at: this.attr(''),

            movies: this.belongsToMany(Movie, EpisodeMovie, 'episode_id', 'movie_id'),
            photo: this.belongsTo(File, 'photo_file_id', 'id')
        }
    }
}
