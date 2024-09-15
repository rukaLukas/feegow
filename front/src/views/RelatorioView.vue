<script setup>
import {ref, onBeforeUnmount} from 'vue';
import Report from '@/api/Report';

const fileName = ref('');
const downloadLink = ref();
const status = ref('')
const polling = ref();

const generateReport = async () => {
    const { data } = await Report.unvaccinatedEmployees();
    status.value = '1';
    if(data != "undefined") {
        startPolling();
    }
}

const startPolling = () => {
    polling.value = setInterval(checkReportStatus, 25000);
}

const checkReportStatus = async () => {
    const data = await Report.checkStatus();
    status.value = data.status;   
    if (data.status === 'completed') {
        fileName.value = data.fileName
        downloadLink.value = data.download_link
        clearInterval(polling.value);
    }
}

onBeforeUnmount(async () => {
    if (polling.value) {
        clearInterval(polling.value);
    }
})
</script>
<template>
    <v-row id="main">        
        <v-col cols="10">
            <h3>{{ $route.meta.breadcrumb[$route.meta.breadcrumb.length - 1].title }}</h3>
        </v-col>        
    </v-row>    
    <v-row>
        <v-col>
            <v-btn 
                density="default"
                @click="generateReport()"
            >
                Clique para extrair relatório
            </v-btn>
        </v-col>
    </v-row>
    <v-row>
        <v-col>
            <span v-if="status != 'completed' && status != ''">Relatório sendo gerado...</span>
            <span v-if="status == 'completed'"><a :href="downloadLink" download>Baixar Relatório</a></span>
        </v-col>
    </v-row>

</template>