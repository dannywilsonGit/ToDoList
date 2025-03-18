<script setup>
import {ref , onMounted , watch} from "vue";
import TodoItem from "./components/TodoItem.vue";

//Déclare une liste de tâches et une variable pour la nouvelle tâche
const tasks = ref([]);
const newTask = ref('');

//charger les taches au demarrage
onMounted(() => {
  const savedTasks = localStorage.getItem("tasks");
  if (savedTasks) {
    tasks.value = JSON.parse(savedTasks);
  }
})


//sauvegarder les taches a chaque modification
watch(tasks, () => {
  localStorage.setItem("tasks", JSON.stringify(tasks.value));
} ,{deep : true})

// Fonction pour ajouter une tâche
const addTask = () => {
  if (newTask.value.trim()) {//Si l'entrée n'est pas vide
    tasks.value.push({ text: newTask.value , completed:false}) //Ajouter la tache a la liste tasks
    newTask.value = ''//reinitialise l'imput
  }
}

const removeTask = (index) => {
  tasks.value.splice(index, 1);
}

const toggleTask = (index) => {
  tasks.value[index].completed = !tasks.value[index].completed;
}
</script>

<template>
  <div class="container">
  <h2>Todo List App</h2>

  <!--Champs texte pour ajouter la nouvelle tache-->
  <input v-model="newTask" placeholder="Ajoutez une tache" @keyup.enter="addTask()" />
  <button @click="addTask()" >Ajouter</button>


  <ul>
    <transition-group name="list" tag="ul">
    <TodoItem
        v-for="(task , index) in tasks"
        :key="index"
        :task = "task.text"
        :completed="task.completed"
        @remove = "removeTask(index)"
        @toggle = "toggleTask(index)"

    />
    </transition-group>
  </ul>


  </div>


</template>

<style scoped>

div {
  border-radius: 10px;
  width: 300px;
  height: 100% ;
  padding: 10px;
  background-color: #86afe0;

}
h2 {

  text-align: center;
  font-family: Arial, sans-serif;
}

input {
  width: 80%;
  padding: 10px;
  margin: 10px;
  border: 1px solid #ddd;
  border-radius: 5px;
}

button {
  background-color: #285fa7;
  color: white;
  border: none;
  padding: 10px;
  cursor: pointer;
  border-radius: 10%;
}

button:hover {
  background-color: #0b1182;
}

ul {
  list-style: none;
  padding: 0;
}

li {
  background: #f8f9fa;
  margin: 5px;
  padding: 10px;
  border-radius: 5px;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

li:hover {
  background-color: #8188f5;
}

button.delete {
  background-color: #dc3545;
}

button.delete:hover {
  background-color: #c82333;
}


 .list-enter-active, .list-leave-active {
   transition: all 0.2s ease;
 }
.list-enter-from, .list-leave-to {
  opacity: 0;
  transform: translateY(-20px);
}



</style>