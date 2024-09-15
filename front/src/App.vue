<!-- <script setup>
import { RouterView } from 'vue-router'
</script> -->
<template>
    <v-app id="app" ref="el">
      
      <!--body-->
      <v-main class="d-flex align-center justify-center">
        <v-container fluid>  
            <v-col 
              cols="10"
              offset="2"
            >
              <h2>- Feegow - </h2>                              
            </v-col>   
            <v-col 
              id="main-menu"
              cols="8"
              offset="2"              
            >
              <v-row>
                <v-col cols="auto">
                  <v-btn 
                    density="default"
                    @click="$router.push({name: 'home'})"
                  >
                    Início
                  </v-btn>
                </v-col>
                <v-col cols="auto">
                  <v-btn 
                    density="default"
                    @click="$router.push({name: 'empregados'})"
                  >
                    Empregados
                  </v-btn>
                </v-col>
                <v-col cols="auto">
                  <v-btn 
                    density="default"
                    @click="$router.push({name: 'vacinas'})"
                  >Vacinas</v-btn>
                </v-col>
                <v-col cols="auto">
                  <v-btn density="default">Vacinação</v-btn>
                </v-col>
                <v-col cols="auto">
                  <v-btn density="default">Relatório de Não Vacinados</v-btn>
                </v-col>                
              </v-row>
            </v-col> 
            <v-col 
              cols="8"
              offset="2"
            >                         
              <v-breadcrumbs 
                  class="ml-n3 mt-n2" 
                  v-if="$route.meta && $route.meta.breadcrumb && $route.meta.breadcrumb.length > 1" 
                  :items="$route.meta.breadcrumb"
              >
                  <template v-slot:divider>
                      <v-icon icon="mdi-chevron-right"></v-icon>
                  </template>
              </v-breadcrumbs>
            </v-col>                  
            <v-row class="layout" justify="center" align="start" style="min-height: 600px;">             
              <v-col 
                cols="10"
                offset="2"
                class="pl-4 mt-7"                
              >                
                <RouterView />
              </v-col>                        
            </v-row>
        </v-container>
      </v-main>      
    </v-app>
  </template>

<style scoped>
  #app {
    /* background-color: #E8F6FC; */
    background-color: #f7f7f7;
    color: #4A4A4A !important;    
  }
  #main-menu {
    background-color: #eeeeee;
    border: 1px solid #b9b8b8;
    border-radius: 4px;
  }
  .layout {   
    color: #4A4A4A !important;    
  }
</style>  