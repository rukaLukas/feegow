<script setup>
import {ref} from 'vue';
import {Field, Form} from 'vee-validate';
import router from "@/router/index";
import Vaccine from '@/api/Vaccine';
import * as yup from "yup";

const name = ref('');
const batch_number = ref('');
const expiration_date = ref('');

/* Validations */
let shape = {};

shape["name"] = yup
  .string()
  .min(4, 'Informe a vacina')
  .required('Nome é um campo obrigatório');
shape["batch_number"] = yup
  .number()
  .typeError('Deve ser um número')
  .required('Lote é um campo obrigatório');
shape["expiration_date"] = yup
  .date()
  .min(new Date(), 'Data inválida')
  .typeError("Data inválida!")
  .required('Data de expiração é um campo obrigatório.');

let schema = yup.object().shape(shape, [['cpf']]);

const onSubmit = async () => {
   
    const formData = {
      name: name.value,
      batch_number: batch_number.value,
      expiration_date: expiration_date.value,      
    };

    submitForm(formData);
}

const submitForm = async (formData) => {
  try {
    let retData; 
    retData = await Vaccine.save(formData);    
    if (retData.ok) {
      return router.push({name: "vacinas"});
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
            <v-col cols="4">
                <Field name="name" v-model="name" v-slot="{ field, errors }">
                    <v-text-field
                        name="name"
                        v-bind="field"
                        variant="outlined"
                        :error-messages="errors"
                        v-model="name"
                        label="Vacina"
                        required
                        type="text"
                    ></v-text-field>
                </Field>
            </v-col>
            <v-col cols="3">
                <Field name="batch_number" v-model="batch_number" v-slot="{ field, errors }">
                    <v-text-field
                      name="batch_number"
                      variant="outlined"
                      v-model="batch_number"
                      v-bind="field"
                      :error-messages="errors"
                      label="Lote"                                   
                      maxlength="14"
                      hint="informe apenas números"
                    ></v-text-field>
                  </Field>
            </v-col> 
            <v-col cols="3">
                <Field name="expiration_date" v-slot="{ field, errors }">
                    <v-text-field
                      name="expiration_date"
                      v-bind="field"
                      variant="outlined"
                      :error-messages="errors"
                      v-model="expiration_date"
                      label="Data de expiração"
                      type="date"                                
                      required                      
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