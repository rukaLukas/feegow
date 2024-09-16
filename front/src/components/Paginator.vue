
<script setup>
import {ref, watch} from 'vue';

let currentPage = ref(1);

const props = defineProps({
  page: Number,
  length: Number,
})

const emit = defineEmits(['page-changed'])

const updateModelValue = () => {
  emit('page-changed', {page: currentPage.value})
};

watch(props, async (next, prev) => {
  currentPage.value = next.page;
})

watch(currentPage, async (next, prev) => {
  currentPage.value = next;
  props.page = next
})

</script>

<template>
    <v-row>
      <v-col cols="10" class="text-center">
        <v-pagination
          :disabled="loading === true"
          elevation="3"
          v-model="currentPage"
          :length="length"
          @update:modelValue="updateModelValue"
        ></v-pagination>
      </v-col>
    </v-row>
  </template>
  
  <style>
  .v-pagination__list button {
    background-color: #FFFFFF;
  }
  
  .v-pagination__list .v-pagination__item--is-active button {
    background:  #4A4A4A !important;
  }
  
  .v-pagination__list .v-pagination__item--is-active button span {
    color: #fff !important;
  }
  </style>
  