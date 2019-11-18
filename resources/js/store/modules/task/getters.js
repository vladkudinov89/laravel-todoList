export default {

    getAllTasks: state => {
        return state.tasks;
    },

    getFilteredTasks: state => searchTask => {
        // console.log(searchTask);
        return state.tasks.filter(task => {
                return task.name.includes(searchTask) || task.description.includes(searchTask);
            }
        )
    },
};
