<script setup>
import {ref, onBeforeUnmount} from 'vue';
import Report from '@/api/Report';

const fileName = ref('');
const downloadLink = ref();
const status = ref('')
const polling = ref();
const snackbar = ref(false); 
const snackbarMessage = ref(''); 
let intervalId = null; 

const generateReport = async () => {
    const { data } = await Report.unvaccinatedEmployees();
    status.value = '1';
    if(data != "undefined") {
        startPolling();
    }
}

const checkReportStatus = async () => {
    const data = await Report.checkStatus();
    status.value = data.status;   
    if (data.status === 'completed') {
        fileName.value = data.fileName
        downloadLink.value = data.download_link

        snackbarMessage.value = 'Your report is ready!';
        snackbar.value = true;
        stopPolling();       
    }
}

// Download the report
const downloadReport = () => {
  if (downloadLink.value) {
    window.location.href = downloadLink.value;
  }
};

const startPolling = () => {
  if (!polling.value) {
    polling.value = true;
    intervalId = setInterval(checkReportStatus, 5000);
  }
};

const stopPolling = () => {
  if (intervalId) {
    clearInterval(intervalId);
    polling.value = false;
  }
};

onBeforeUnmount(async () => {
    stopPolling();
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
            <span v-if="status != 'completed' && status != ''">Relatório sendo gerado, quando estiver pronto você receberá uma notificação</span>
            <span v-if="status == 'completed'"><a :href="downloadLink" download>Baixar Relatório</a></span>
        </v-col>
    </v-row>

    <v-snackbar
      v-model="snackbar"
      :timeout="20000"
      vertical
    >
      <div class="text-subtitle-1 pb-2">Relatório está pronto</div>
      <p>Clique no botão abaixo para baixar</p>    
      <template v-slot:actions>
        <v-btn
          color="#4A4A4A"
          style="background-color: #FFF"
          variant="text"
          @click="downloadReport"
        >
            Baixar Relatório
        </v-btn>
    </template>      
    </v-snackbar>

</template>