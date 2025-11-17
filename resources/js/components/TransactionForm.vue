<template>
    <div class="w-full bg-slate-800 rounded-lg shadow-lg p-6">
        <h3 class="text-xl font-semibold text-white mb-6">Nova Transação</h3>

        <form @submit.prevent="store" class="flex flex-col gap-5">

            <div class="flex justify-center gap-6">
                <label class="flex items-center cursor-pointer">
                    <input type="radio" v-model="type" value="income" class="sr-only peer" />
                    <span
                        class="w-4 h-4 rounded-full border-2 border-gray-600 peer-checked:bg-emerald-500 peer-checked:border-emerald-500"></span>
                    <span class="ml-2 font-medium text-emerald-500">Ganho</span>
                </label>

                <label class="flex items-center cursor-pointer">
                    <input type="radio" v-model="type" value="expense" class="sr-only peer" />
                    <span
                        class="w-4 h-4 rounded-full border-2 border-gray-600 peer-checked:bg-red-500 peer-checked:border-red-500"></span>
                    <span class="ml-2 font-medium text-red-500">Gasto</span>
                </label>
            </div>

            <div>
                <label for="title" class="block text-sm font-medium text-gray-300 mb-1">Nome</label>
                <input type="text" id="title" v-model="title"
                    class="block w-full bg-slate-700 border border-slate-600 rounded-md py-2 px-3 text-white placeholder-gray-400 focus:ring-yellow-500 focus:border-yellow-500"
                    placeholder="Ex: Salário" />
            </div>

            <div>
                <label for="descricao" class="block text-sm font-medium text-gray-300 mb-1">Descrição (Opcional)</label>
                <textarea id="descricao" v-model="description" rows="3"
                    class="block w-full bg-slate-700 border border-slate-600 rounded-md py-2 px-3 text-white placeholder-gray-400 focus:ring-yellow-500 focus:border-yellow-500"
                    placeholder="Ex: Pagamento da primeira quinzena"></textarea>
            </div>

            <div>
                <label for="category" class="block text-sm font-medium text-gray-300 mb-1">Categoria</label>
                <div class="flex items-center gap-2">
                    <select id="category" v-model="selectedCategory"
                        class="block w-full bg-slate-700 border border-slate-600 rounded-md py-2 px-3 text-white placeholder-gray-400 focus:ring-yellow-500 focus:border-yellow-500 flex-grow">
                        <option :value="null" disabled>Selecione uma categoria</option>
                        <option v-for="cat in props.categories" :key="cat.id" :value="cat.id">
                            {{ cat.name }}
                        </option>
                    </select>

                    <button type="button" @click="showCategoryModal = true" aria-label="Adicionar Categoria"
                        class="flex-shrink-0 p-2.5 bg-slate-700 hover:bg-slate-600 rounded-md">
                        <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                    </button>

                    <Modal :isOpen="showCategoryModal" @close="showCategoryModal = false">
                        <CategoryForm @category-added="onCategoryAdded" />
                    </Modal>
                </div>
            </div>

            <div>
                <label for="amount" class="block text-sm font-medium text-gray-300 mb-1">Valor</label>
                <input type="number" id="amount" v-model="amount"
                    class="block w-full bg-slate-700 border border-slate-600 rounded-md py-2 px-3 text-white placeholder-gray-400 focus:ring-yellow-500 focus:border-yellow-500"
                    placeholder="R$ 0,00" step="0.01" />
            </div>

            <div class="flex items-center gap-3">
                <input type="checkbox" id="recorrente" v-model="isRecurring"
                    class="h-4 w-4 rounded bg-slate-700 border-slate-600 text-yellow-500 focus:ring-yellow-500" />
                <label for="recorrente" class="text-gray-300">Recorrente</label>
            </div>

            <div v-if="isRecurring">
                <label for="transaction_date" class="block text-sm font-medium text-gray-300 mb-1">
                    Data da Transação
                </label>

                <input type="date" id="transaction_date" v-model="transaction_date" style="color-scheme: dark;"
                    class="block w-full bg-slate-700 border border-slate-600 rounded-md py-2 px-3 text-white focus:ring-yellow-500 focus:border-yellow-500" />
            </div>

            <button type="submit"
                class="w-full bg-yellow-500 border border-yellow-500 text-black font-bold py-2.5 px-4 rounded-md hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:ring-opacity-75">
                Salvar
            </button>
        </form>
    </div>
</template>

<script setup>
import { ref } from 'vue'
import { useForm } from '@inertiajs/vue3'
import Modal from './Modal.vue'
import CategoryForm from './CategoryForm.vue'

const emit = defineEmits(['transaction-registered'])

const type = ref('income')
const title = ref('')
const description = ref('')
const amount = ref(0)
const isRecurring = ref(false)
const selectedCategory = ref(null)
const transaction_date = ref(null)
const showCategoryModal = ref(false)

const props = defineProps({
    categories: Array
})

const store = () => {
    const form = useForm({
        type: type.value,
        title: title.value,
        description: description.value,
        amount: amount.value,
        isRecurring: isRecurring.value,
        category_id: selectedCategory.value,
        transaction_date: transaction_date.value,
    })

    form.post('/transactions', {
        onSuccess: () => {
            emit('transaction-registered')
            type.value = 'income'
            title.value = ''
            description.value = ''
            amount.value = 0
            isRecurring.value = false
            selectedCategory.value = null
            transaction_date.value = null
        },
    })
}

const onCategoryAdded = (newCategory) => {
    props.categories.push(newCategory)
    showCategoryModal.value = false
}
</script>
