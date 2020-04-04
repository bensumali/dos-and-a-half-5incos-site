import { Model } from '@vuex-orm/core'

export default class File extends Model {
    static entity = 'files';

    static fields () {
        return {
            id: this.uid(),
            original_name: this.attr(''),
            mime_type: this.attr(''),
            size: this.attr(''),
            path: this.attr(''),
        }
    }
}
