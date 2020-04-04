import Episode from "../models/Episode";
import axios from 'axios'

let actions = {
    STORE_EPISODE: function(context, payload) {
        return Episode.api().post('/api/episodes/', payload);
    }
};

export default actions;
