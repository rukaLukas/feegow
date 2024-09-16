<template>
  <form-self
    @handle-success="toList"
    @handle-back-button="toList"
    title="Cadastrar Colaborador"
  ></form-self>
</template>

<script setup>
import FormSelf from './Form.vue'
import router from "../../router";

const toList = () => {
  router.push({name: 'empregados'})
};
</script>