<script setup>
import {onMounted, ref} from 'vue';
import {Field, Form} from 'vee-validate';
import Employee from '@/api/Employee';
import * as stringHelpers from '@/helpers/string';
import {validateCPF} from 'validations-br';
import * as yup from "yup";
import {useRoute} from "vue-router";

const emit = defineEmits();
const id = ref(null);
const route = useRoute()

const name = ref('');
const cpf = ref('');
const date_of_birth = ref('');
const comorbidities = ref(false);

/* Validations */
let shape = {};


shape["name"] = yup.string().min(8, 'Informe o nome completo').required('Nome é um campo obrigatório');
shape["cpf"] = yup.string()
  .test('test-invalid-cpf', 'CPF inválido', (cpf) => validateCPF(cpf)).required('CPF é obrigatório');

shape["date_of_birth"] = yup
  .date()
  .max(new Date(), 'Data inválida')
  .typeError("Data inválida!")
  .required('Data de nascimento é um campo obrigatório.');

let schema = yup.object().shape(shape, [['cpf']]);

onMounted(async () => {
  id.value = route.params.id ? route.params.id : null;
  if (id.value) {
    await find();
  }
})


const find = async () => {
    const {data} = await Employee.find(id.value);
    name.value = data.name
    cpf.value = data.cpf
    date_of_birth.value = data.date_of_birth,
    comorbidities.value = data.comorbidities == 0 ? false : true
};

const onSubmit = async () => {
   
    const formData = {
      name: name.value,
      cpf: stringHelpers.removeMask(cpf.value),
      date_of_birth: stringHelpers.removeMask(date_of_birth.value),
      comorbidities: comorbidities.value     
    };

    submitForm(formData);
}

const submitForm = async (formData) => {
    try {
    let retData;
    if (id.value) {
      retData = await Employee.update(id.value, formData);
    } else {
        retData = await Employee.save(formData);
    }            
    if (retData.ok) {
        emit('handle-success');
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
    <Form id="create-employee" @submit="onSubmit" :validation-schema="schema">
        <v-row>        
            <v-col cols="10">
                <Field name="name" v-model="name" v-slot="{ field, errors }">
                    <v-text-field
                        name="name"
                        v-bind="field"
                        variant="outlined"
                        :error-messages="errors"
                        v-model="name"
                        label="Nome completo"
                        required
                        type="text"
                    ></v-text-field>
                </Field>
            </v-col>
            <v-col cols="4">
                <Field name="cpf" v-model="cpf" v-slot="{ field, errors }">
                    <v-text-field
                      name="cpf"
                      variant="outlined"
                      v-model="cpf"
                      v-bind="field"
                      :error-messages="errors"
                      label="CPF"                                   
                      maxlength="14"
                      hint="informe apenas números sem pontos e hífen"
                    ></v-text-field>
                  </Field>
            </v-col> 
            <v-col cols="3">
                <Field name="date_of_birth" v-model="date_of_birth" v-slot="{ field, errors }">
                    <v-text-field
                      name="date_of_birth"
                      v-bind="field"
                      variant="outlined"
                      :error-messages="errors"
                      v-model="date_of_birth"
                      label="Data de nascimento"
                      type="date"                                
                      required                      
                    ></v-text-field>
                  </Field>
            </v-col>  
            <v-col cols="3" class="mt-n5">  
                Comorbidade           
                <v-radio-group
                    v-model="comorbidities"
                >
                <v-col cols="auto">
                    <v-radio
                        label="Sim"
                        :value="true"
                        color="primary"
                        class="float-left"
                    ></v-radio>
                    <v-radio
                        label="Não"
                        :value="false"
                        color="primary"
                        class="float-left"
                    >
                    </v-radio>                    
                </v-col>                
                </v-radio-group>          
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