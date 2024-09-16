<script setup>
import {ref} from 'vue';
import Vaccination from '@/api/Vaccination';

import List from '@/components/List.vue';

const fields = ref([
  {"field": "employee.name", "alias": "colaborador"},
  {"field": "vaccine.name", "alias": "vacina"},
  {"field": "first_dose_date", "alias": "data 1º dose"},
  {"field": "second_dose_date", "alias": "data 2º dose"},
  {"field": "third_dose_date", "alias": "data 3º dose"}
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
                @click="$router.push({name: 'vacinas-create'})"
            >
                Cadastrar Vacinação
            </v-btn>
        </v-col>
    </v-row>  
    <List
        :fields="fields"
        :api="Vaccination"
        :label="'Registros de vacinações'"
        :route="'vaccination'"       
    >
    </List>
</template>