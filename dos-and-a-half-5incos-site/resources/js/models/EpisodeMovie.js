import { Model } from '@vuex-orm/core'
import Movie from "./Movie";

export default class EpisodeMovie extends Model {
    // This is the name used as module name of the Vuex Store.
    static entity = 'episode_movie';
    static primaryKey = ['episode_id', 'movie_id']
    // List of all fields (schema) of the post model. `this.attr` is used
    // for the generic field type. The argument is the default value.
    static fields () {
        return {
            episode_id: this.attr(''),
            movie_id: this.attr(''),
            created_at: this.attr(''),
        }
    }
}
