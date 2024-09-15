<script setup>
import {ref} from 'vue';
import Vacina from '@/api/Vaccine';

import List from '@/components/List.vue';

const fields = ref([
  {"field": "id", "alias": "id"},
  {"field": "name", "alias": "nome"},
  {"field": "batch_number", "alias": "lote"},
  {"field": "expiration_date", "alias": "data de expiração"},
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
                Cadastrar Vacina
            </v-btn>
        </v-col>
    </v-row>  
    <List
        :fields="fields"
        :api="Vacina"
        :label="'Vacinas'"
        :route="'vaccines'"       
    >
    </List>
</template>