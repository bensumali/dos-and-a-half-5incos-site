import { Model } from '@vuex-orm/core'

export default class Episode extends Model {
    // This is the name used as module name of the Vuex Store.
    static entity = 'episodes';

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
        }
    }
}
