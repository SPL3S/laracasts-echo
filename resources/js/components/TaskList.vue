<template>
    <div class="col-sm-12">
        <h2 v-text="projectName"></h2>
        <ul>
            <li v-for="task in project.tasks" v-text="task.body"></li>
        </ul>
        <input class="form-control" type="text" v-model="newTask" @blur="save">
    </div>
</template>

<script>
    export default {
        props: ['dataProject'],

        data() {
            console.log(this.dataProject);
            return {
                project: this.dataProject,
                newTask: '',
                projectName: this.dataProject.name
            };
        },

        created() {
            window.Echo.channel('tasks.' + this.project.id).listen('TaskCreated', ({task}) => this.addTask(task));
        },

        methods: {
            save() {
                axios.post(window.hostname + `/api/projects/${this.project.id}/tasks`, { body: this.newTask })
                .then(response => response.data)
                .then(this.addTask);
            },

            addTask(task){
                this.project.tasks.push(task);

                this.newTask = '';
            }
        }
    }
</script>
