import { Model } from '@vuex-orm/core'

export default class Movie extends Model {
    // This is the name used as module name of the Vuex Store.
    static entity = 'movies';
    static primaryKey = 'id';
    // List of all fields (schema) of the post model. `this.attr` is used
    // for the generic field type. The argument is the default value.
    static fields () {
        return {
            id: this.uid(),
            title: this.attr(''),
            release_date: this.attr(''),
            poster_path: this.attr(''),
            created_at: this.attr(''),
        }
    }
}
