import getters from "./getters";

export default {

    addNewTask: (context, payload) => {
        return new Promise(((resolve, reject) => {
            let data = new FormData();
            data.append('name', payload.name);
            data.append('description', payload.description);
            data.append('status', payload.status);
            axios.post('/api/v1/tasks', data)
                .then((result) => {
                    let reviewData = Object.assign({}, result.data.data);
                    context.commit('ADD_TASK', reviewData);
                    resolve(result.data.data);
                })
                .catch((error) => {
                    reject(error);
                });
        }))
    },

    updateTask: (context, data) => {
        return new Promise((resolve, reject) => {

            axios.put(`/api/v1/tasks/${data.id}` , data)
                .then((response) => {
                    context.commit('UPDATE_TASK' , response.data.data);
                    resolve(response.data.data);
                });
        });
    },

    fetchTasks: (context) => {
        return new Promise((resolve, reject) => {
            axios.get('/api/v1/tasks')
                .then((response) => {
                    context.commit('SET_TASKS', response.data);
                    resolve(response.data);
                }).catch(function (err) {
                reject(err);
            });
        });
    },

    deleteTask: (context, id) => {
        return new Promise((resolve, reject) => {
            axios.delete('/api/v1/tasks/' + id)
                .then((response) => {
                    context.commit('DELETE_TASK', id);
                    return response.data.data;
                }).catch((error) => {
                reject(error);
            });
        });
    },

};
