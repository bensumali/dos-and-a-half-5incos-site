import Episode from "../models/Episode";
import axios from 'axios'

let actions = {
    GET_ALL_EPISODES: function(context, payload) {
        return Episode.api().get("/api/episodes");
    },
    STORE_EPISODE: function(context, payload) {
        Episode.delete(payload.id);
        return Episode.api().post('/api/episodes/', payload);
    }
};

export default actions;
