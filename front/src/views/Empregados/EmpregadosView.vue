<script setup>
import {ref} from 'vue';
import Employee from '@/api/Employee';

import List from '@/components/List.vue';

const fields = ref([
  {"field": "id", "alias": "id"},
  {"field": "name", "alias": "nome"},
  {"field": "cpf", "alias": "cpf"},
  {"field": "date_of_birth", "alias": "data de nascimento"},
  {"field": "comorbidities", "alias": "comorbidades"},
]);
</script>

<template>
    <v-row id="main" class="mb-5">        
        <v-col cols="10">
            <h3>{{ $route.meta.breadcrumb[$route.meta.breadcrumb.length - 1].title }}</h3>
        </v-col>
    </v-row> 
    <v-row>
        <v-col cols="10">
            <v-btn 
                density="default"
                @click="$router.push({name: 'empregados-create'})"
            >
                Cadastrar Empregado
            </v-btn>
        </v-col>
    </v-row>  
    <List
        :fields="fields"
        :api="Employee"
        :label="'Empregados'"
        :route="'empregados'"
        style="z-index: -1"        
    >
    </List>
</template>