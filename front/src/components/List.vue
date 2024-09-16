<template>   
    <v-row class="mt-1">
      <v-col cols="10" class="text-left">
        <h2>Exibindo {{ total }} {{ label }} criados</h2>
      </v-col>
    </v-row>
    <v-row class="">
      <v-col cols="10">
        <v-table
          height="650px"
          fixed-header
        >
          <thead>
            <tr style="background-color: #1CABE2;">
              <th v-for="field in fields"
                  :key="field.id"
              >              
              <div>{{ field.alias }}</div>
            </th>
              <th class="text-left">
                Ações
              </th>
            </tr>
          </thead>
          <tbody
            v-if="items.length > 0"
          >
            <tr
                v-for="item in items"
                :key="item.id"
            >
              <td 
                v-for="field in fields"
                :key="field.id"
              >
                <div v-if="!slots['customRowsValues']">                  
                  {{ getDescriptionName(item, field)}}
                </div>
                <div v-else>
                  <slot name="customRowsValues" :item="item" :field="field" :getDescriptionName="getDescriptionName"></slot>
                </div>
              </td>
              <td style="color: #9c9c9c" v-if="!slots['custombuttonActions']">                
                <!-- <router-link :to="`/${route}/edit/${item.id}`" class="">
                  <v-icon alt="EDITAR" title="EDITAR" size="default" icon="mdi-pencil"/>
                </router-link> -->                          
                <v-icon class="pl-5" title="Deletar" alt="Deletar" size="default"
                        @click="deleteItem(item.id)" icon="mdi-delete"/>
              </td>                          
            </tr>
          </tbody>
        </v-table>
        <br/>
        <br/>
      </v-col>
    </v-row>
    <!-- <Paginator :length="length" :page="page" @page-changed="getAll($event)"/> -->




    <!-- Confirmation Dialog -->
    <v-dialog v-model="showConfirmDialog" max-width="400">
      <v-card>
        <v-card-title class="text-h6">
          Confirma Exclusão
        </v-card-title>

        <v-card-text>
          Tem certeza que quer deletar este item?
        </v-card-text>

        <v-card-actions>
          <!-- Cancel button -->
          <v-btn text @click="cancelDelete">
            Cancelar
          </v-btn>

          <!-- Confirm delete button -->
          <v-btn color="red" text @click="confirmDelete">
            Confirmar
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </template>
  <script lang="ts" setup>
  import {onMounted, PropType, ref, useSlots, defineExpose, watch} from 'vue';
    // import Paginator from './Paginator.vue';
    import {ListInterface} from '../interfaces/listInterface'
    
    const props = defineProps({
      api: Object,
      fields: Array as PropType<ListInterface[]>,
      filtersComponent: {
        default: false,
        type: Boolean
      },
      route: String,
      label: String,    
    });
    

    const idItemDelete = ref();
    // DIALOG CONFIRMATION DELETE
    const showConfirmDialog = ref(false);

    const cancelDelete = () => {
        showConfirmDialog.value = false;
    };

    const confirmDelete = async () => {

        showConfirmDialog.value = false;
        let {status} = await props.api.destroy(idItemDelete.value);
        if (status) {
            await getAll()
        }              
    };



    const items = ref([]);
    let page = ref(1);
    let total = ref(0);
    let length = ref(0);
    const slots = useSlots()
  
    const getDescriptionName = (item, field) => { 
      // percorre valores de atributos que são objetos 
      if (field.field.includes('.')) {
        const arr = field.field.split('.');

        if (arr.length == 2) {
          const initial = item[arr[0]];
          return initial[arr[1]]
        }

        if (arr.length == 3) {
          const first = item[arr[0]];
          const second = first[arr[1]];
          return second[arr[2]]
        }
      }
    
      return item[field.field]
    }
  
    const deleteItem = async (id: number | string) => {

        idItemDelete.value = id;
        showConfirmDialog.value = true   
    }
  
    const getAll = async (searchF = "") => {
    //   const paramsRoute = new URLSearchParams(props.customSearch);
    //   const paramType = paramsRoute.get("type");
  
    //   if (paramType != null) searchF['type'] = paramType;
    //   page.value = searchF['page'] || props?.search?.page
    //   let pageValue = page.value
    //   const getAllsearch = {
    //     ...props.search,
    //     page: pageValue,
    //     ...Object.fromEntries(paramsRoute.entries())
    //   }
      const {data} = await props.api.getAll();
      buildResults(data);
    }    
  
    const buildResults = (data) => {
      if (data.data[0] != undefined || data.data[0] != null) {
        items.value = data.data;
        total.value = data.total;        
        length.value = data.last_page;
      } else {
        items.value = [];
        total.value = 0;
        length.value = 1;
      }
    }
   
    defineExpose({
        getAll,
        deleteItem
    })
  
    onMounted(async () => {
      await getAll();
    });
  
</script>
  <style scoped>
  thead * {
    color: #9c9c9c !important;
    font-weight: bold;    
  }
  
  
  ul, ul li {
    display: inline;
    padding: 0 10px;
  }
  </style>
  <style>
  #btn-create {
    background-color: #FDC300;
    border-color: #E3AF00;
  }

  tbody a {
    text-decoration: none;
    color: inherit;
  }

  thead a {
    text-decoration: none;
  }
  
  .v-table.v-table--fixed-header > .v-table__wrapper > table > thead > tr > th {
    background-color: #eeeeee;
    color: #000;
  }
  </style>
  