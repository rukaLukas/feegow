<template>
    <v-row id="main">        
        <v-col cols="10">
            <h3>{{ $route.meta.breadcrumb[$route.meta.breadcrumb.length - 1].title }}</h3>
        </v-col>        
    </v-row>    
    <v-row>
        <v-col>
            <p>Sistema de controle de colaboradores vacinados contra a COVID-19</p>
        </v-col>
    </v-row>
</template>