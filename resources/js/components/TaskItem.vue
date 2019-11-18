<template>
    <div class="col-4 mb-3">

        <div class="card" style="width: auto;">
            <div v-show="!isEditing" class="card-body">
                <h5 class="card-title">{{task.name}}</h5>
                <p class="card-text">{{task.description}}</p>
                <p class="card-text">{{showStatus(task.status)}}</p>
                <button type="button" class="btn btn-info" @click="editTask">Edit</button>
                <button type="button" class="btn btn-danger" @click="deleteTask(task.id)">Delete
                </button>
            </div>

            <div v-show="isEditing" class="card-body" v-bind:class="{'text-muted' : status}">
                <div class="mb-3">
                    <input v-model="currentTask.name" type="text">
                </div>
                <div class="mt-3 mb-3">
                    <textarea v-model="currentTask.description" class="form-control" id="message-text"></textarea>
                </div>
                <div class="mt-3 mb-3">
                    <label>Select status</label>
                    <select class="ui dropdown selection search_select " v-model="currentTask.status">
                        <option v-for="(selStatus , index) in selectStatus"
                                :key="index" v-bind:value="selStatus.status">
                            {{selStatus.nameParam}}
                        </option>
                    </select>
                </div>
                <button type="button" class="btn btn-outline-info" @click="updateTask(task.id)">Update Task</button>
                <button type="button" class="btn btn-outline-danger" @click="cancelEdit">Cancel</button>
            </div>
        </div>

    </div>
</template>

<script>
    import {mapState, mapGetters, mapActions} from 'vuex';

    export default {
        name: "TaskItem",
        props: ['task', 'status'],
        data: function () {
            return {
                selectStatus: [
                    {
                        nameParam: 'complete',
                        status: true
                    },
                    {
                        nameParam: 'not complete',
                        status: false
                    }
                ],
                currentTask: {
                    id: this.task.id,
                    name: this.task.name,
                    description: this.task.description,
                    status: this.task.status
                },
                isEditing: false,
            }
        },
        methods: {
            ...mapActions('task', {
                    delete: 'deleteTask',
                    update: 'updateTask'
                }
            ),

            showStatus(status) {
                if (status === true) {
                    return "complete";
                } else {
                    return "not complete";
                }
            },
            editTask() {
                this.isEditing = true;
            },
            updateTask(id) {
                this.update({
                    id: this.currentTask.id,
                    name: this.currentTask.name,
                    description: this.currentTask.description,
                    status: this.currentTask.status
                }).then((result) => {
                    // console.log(result);
                    this.isEditing = false;
                }).catch(function (response) {
                    console.log(response);
                    alert("Could not update task");
                });
            },
            cancelEdit() {
                this.isEditing = false;
            },
            deleteTask(id) {
                this.$emit('delete-task', id);
            }
        }

    }
</script>

<style scoped>

</style>
