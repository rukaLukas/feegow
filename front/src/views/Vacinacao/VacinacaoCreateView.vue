<script setup>
import {ref, onMounted} from 'vue';
import {Field, Form} from 'vee-validate';
import router from "@/router/index";
import Vaccination from '@/api/Vaccination';
import Employee from '@/api/Employee';
import Vaccine from '@/api/Vaccine';
import * as yup from "yup";

const itemsEmployee = ref([]);
const itemsVaccine = ref([]);
const employee = ref();
const vaccine = ref();
const first_dose_date = ref('');
const second_dose_date = ref('');
const third_dose_date = ref('');


const getListEmployees = async () => {
  try {
    const response = await Employee.getAll();
    itemsEmployee.value = response.data.data;
  } catch (e) {
    console.log(e);
  }
}

const getListVaccines = async () => {
  try {
    const response = await Vaccine.getAll();
    itemsVaccine.value = response.data.data;
  } catch (e) {
    console.log(e);
  }
}

onMounted(async () => {
  getListEmployees();
  getListVaccines();
})


/* Validations */
let shape = {};

shape["employee"] = yup.string().required('Colaborador é um campo obrigatório');
shape["vaccine"] = yup.string().required('Vacina é um campo obrigatório');
shape["first_dose_date"] = yup
  .date()
  // .min(new Date(), 'Data inválida')
  .typeError("Data inválida!")
  .required('data aplicação 1º dose é um campo obrigatório.');

shape["second_dose_date"] = yup
  .date()
  .min(yup.ref('first_dose_date'), 'A data da 2ª dose deve ser após a 1ª dose.')
  .typeError('Data inválida!');

  shape["third_dose_date"] = yup
  .date()
  .min(yup.ref('first_dose_date'), 'A data da 3ª dose deve ser após a 2ª dose.')
  .typeError('Data inválida!')

let schema = yup.object().shape(shape);

const onSubmit = async () => {
   
    const formData = {
      employee_id: employee.value,
      vaccine_id: vaccine.value,           
      first_dose_date: first_dose_date.value,
      second_dose_date: second_dose_date.value,
      third_dose_date: third_dose_date.value    
    };

    submitForm(formData);
}

const submitForm = async (formData) => {
  try {
    let retData; 
    retData = await Vaccination.save(formData);    
    if (retData.ok) {
      console.log(retData);
      return router.push({name: "vacinacao"});
    }
  } catch (e) {
    console.log(e);
  }
}
</script>

<template>
    <v-row id="main" class="mb-5">        
        <v-col cols="10">
            <h3>{{ $route.meta.breadcrumb[$route.meta.breadcrumb.length - 1].title }}</h3>
        </v-col>
    </v-row>
    <Form id="create-vaccine" @submit="onSubmit" :validation-schema="schema">
        <v-row>        
            <v-col cols="2">
              <Field name="employee" v-model="employee" v-slot="{ field, errors }">
                <v-select
                  v-bind="field"
                  :error-messages="errors"
                  v-model="employee"
                  :items="itemsEmployee"
                  item-title="name"
                  item-value="id"
                  label="Colaborador"
                  variant="outlined"
                  required
                ></v-select>
              </Field>
            </v-col>
            <v-col cols="2">
                <Field name="vaccine" v-model="vaccine" v-slot="{ field, errors }">
                    <v-select
                      v-bind="field"
                      :error-messages="errors"
                      v-model="vaccine"
                      :items="itemsVaccine"
                      item-title="name"
                      item-value="id"
                      label="Vacina"
                      variant="outlined"
                      required
                    ></v-select>
                  </Field>
            </v-col> 
            <v-col cols="2">
                <Field name="first_dose_date" v-slot="{ field, errors }">
                    <v-text-field
                      name="first_dose_date"
                      v-bind="field"
                      variant="outlined"
                      :error-messages="errors"
                      v-model="first_dose_date"
                      label="data aplicação 1º dose"
                      type="date"                                
                      required                      
                    ></v-text-field>
                  </Field>
            </v-col>  
            <v-col cols="2">
                <Field name="second_dose_date" v-slot="{ field, errors }">
                    <v-text-field
                      name="second_dose_date"
                      v-bind="field"
                      variant="outlined"
                      :error-messages="errors"
                      v-model="second_dose_date"
                      label="data aplicação 2º dose"
                      type="date"                   
                    ></v-text-field>
                  </Field>
            </v-col> 
            <v-col cols="2">
                <Field name="third_dose_date" v-slot="{ field, errors }">
                    <v-text-field
                      name="third_dose_date"
                      v-bind="field"
                      variant="outlined"
                      :error-messages="errors"
                      v-model="third_dose_date"
                      label="data aplicação 3º dose"
                      type="date"                                            
                    ></v-text-field>
                  </Field>
            </v-col>                 
        </v-row>
        <v-row>
            <v-col cols="auto">
                <v-btn 
                    type="submit"
                    density="default"                
                  >
                    Cadastrar
                  </v-btn>
            </v-col>
        </v-row>
    </Form>    
</template>

<style>
.v-input__control {
  background-color: #FFF !important;
}
</style>