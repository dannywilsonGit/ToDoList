<script setup>
defineProps(['task' , 'completed'])
const emit = defineEmits(['remove' , 'toggle']) // Permet d'envoyer un événement au parent
</script>

<template>
  <li :class="{ done: completed} " >
    <input type="checkbox" class="checkbox"  :checked="completed" @change="emit('toggle')">
    <span>{{task}}</span>
    <button class="delete" @click="emit('remove')">❌</button>
  </li>
</template>



