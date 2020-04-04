import Vue from 'vue'
import Vuex from 'vuex'
import actions from "./actions";
import User from "../models/User"
import VuexORM from "@vuex-orm/core";
import VuexORMAxios from "@vuex-orm/plugin-axios";
import axios from 'axios';


Vue.use(Vuex)
VuexORM.use(VuexORMAxios, {axios});

// Create a new database instance.
const database = new VuexORM.Database()
database.register(User);
// Register Models to the database.


// Create Vuex Store and register database through Vuex ORM.
const store = new Vuex.Store({
    actions,
    plugins: [VuexORM.install(database)]
})

export default store
