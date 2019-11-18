
function getTaskById(tasks , taskId){
    return tasks.find( task => {
        return task.id === parseInt(taskId);
    });
}

export default {

    SET_TASKS: (state, tasks) => {
        state.tasks = tasks;
    },

    ADD_TASK: (state, task) => {
        state.tasks.push(task);
    },

    UPDATE_TASK: (state , data) => {
        let task = getTaskById(state.tasks , data.id);
        task.name = data.name;
        task.description = data.description;
        task.status = data.status;
    },

    DELETE_TASK: (state , id) => {
        const index = state.tasks.findIndex(task => task.id == id);
        state.tasks.splice(index , 1);
    },
}
