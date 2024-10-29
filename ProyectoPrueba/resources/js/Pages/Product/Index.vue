<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

import { Head,useForm  } from '@inertiajs/vue3';

import { ref } from 'vue';

const isModalOpen = ref(false);
const form = useForm({
  nombre: '',
  precio: ''
});

// Función para enviar los datos al controlador
function submitForm() {
  form.post('/producto', {
    onSuccess: () => {
      isModalOpen.value = false;
      form.reset();
    }
  });
}



</script>






<template>
    <Head title="Dashboard" />


 
 <meta name="csrf-token" content="{{ csrf_token() }}">

    <AuthenticatedLayout>
        <template #header>
            <h2
                class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200"
            >
             Productos
            </h2>
        </template>


   


        
        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">



                <div class="flex justify-between mb-4">
                <!-- Campo de búsqueda -->
              
                
                <!-- Botón para agregar nuevo producto -->
                <button 
                    @click="isModalOpen = true"
                    class="px-4 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700 focus:outline-none focus:bg-blue-700"
                >
                    Agregar Producto
                </button>
            </div>



        <div v-if="isModalOpen" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 z-50">
          <div class="bg-white rounded-lg p-6 shadow-lg w-full max-w-md mx-auto z-50">
           <slot name="title">Agregar Producto</slot> 
            <form @submit.prevent="submitForm">
            <slot name="content">
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700">Nombre</label>
                    <input v-model="form.nombre" type="text" class="w-full px-4 py-2 border rounded-lg" />
                </div>
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700">Precio</label>
                    <input v-model="form.precio" type="number" class="w-full px-4 py-2 border rounded-lg" />
                </div>
                <div class="flex justify-end mt-6">
                    <button type="button" @click="isModalOpen = false" class="px-4 py-2 bg-gray-500 text-white rounded-lg mr-2">Cancelar</button>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg">Guardar</button>
                </div>
            </slot>
            </form>
          </div>
        </div>





















                <!--Tabla de productos-->
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                Id
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Nombre
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Precio
                                </th>
                        
                                <th scope="col" class="px-6 py-3">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="product in products" :key="product.id" class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700" >
                    

                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ product.id }} 
                                </th>
                                <td class="px-6 py-4">
                                    {{ product.nombre }} 
                                </td>
                                <td class="px-6 py-4">
                                    {{ product.precio }} 
                                </td>

                                <td class="px-6 py-4">
                                    <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Edit</a>
                                </td>
                            </tr>
                            
                        
                        
                        </tbody>
                    </table>
                </div>

                   
                    </div>
                </div>
          

                      
    </AuthenticatedLayout>
</template>
<script>
export default {

// Recibe los props enviados desde el controlador
props: {
    products:{type: Array,
        required:true
    }
}
};
</script>