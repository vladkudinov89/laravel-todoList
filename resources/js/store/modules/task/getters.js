export default {

    getAllTasks: state => {
        return state.tasks;
    },

    getFilteredTasks: state => searchTasks => {
        if(searchTasks.length == 0 || searchTasks == -1){
            return state.tasks;
        } else {
             return searchTasks;
         }
    },
};
