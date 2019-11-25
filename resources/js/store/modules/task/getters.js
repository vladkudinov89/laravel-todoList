export default {

    getAllTasks: state => {
        return state.tasks;
    },

    getFilteredTasks: state => searchTasks => {
        if(searchTasks.length == 0){
            return state.tasks;
        } else {
             return state.tasks = searchTasks;
         }
    },
};
