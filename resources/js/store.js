import Vue from 'vue'
import Vuex from 'vuex';


Vue.use(Vuex);

export const store = new Vuex.Store({
    state: {
        drawer: true,
    },
    getters: {
        getStateDrawer: state => {
            return state.drawer
        }
    },
    mutations: {
        MODIFY_DRAWER: (state, value) => {
            state.drawer = value
        }
    },
    actions: {
        modifyDrawer: (context, value) => {
            context.commit("MODIFY_DRAWER", value)
        }
    }

});
