<script setup>
import { useForm, Link } from '@inertiajs/vue3';
import { ref } from 'vue';

const isVisible = ref(true)

const email = ref(null)
const password = ref(null)

const form = useForm({
    email: email.value,
    password: password.value,
});

const toggleVisibility = () => {
    isVisible.value = !isVisible.value
}

const submit = () => {
    console.log("Enviando...", form.data());
    form.post('/auth', {
        onSuccess: () => {
            email.value = "",
                password.value = ""
        },
    })
};
</script>

<template>
    <div class="min-h-screen flex items-center justify-center bg-slate-950 p-4 relative overflow-hidden">

        <div
            class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-3xl h-96 bg-blue-600/20 blur-[100px] rounded-full pointer-events-none opacity-50">
        </div>

        <div class="w-full max-w-md relative z-10">

            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-white tracking-tight">FinTrack</h1>
                <p class="text-slate-400 mt-2">Suas finanças sob controle.</p>
            </div>

            <div class="bg-slate-900/50 border border-slate-800 backdrop-blur-xl rounded-2xl shadow-2xl p-8">
                <h2 class="text-xl font-semibold text-white mb-6">Acesse sua conta</h2>

                <form @submit.prevent="submit">
                    <div class="mb-5">
                        <label for="email" class="block text-sm font-medium text-slate-300 mb-2">Email</label>
                        <div class="relative">
                            <div
                                class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-500">
                                <i class="pi pi-envelope"></i>
                            </div>
                            <input id="email" v-model="form.email" type="email" required autofocus
                                class="w-full bg-slate-950/50 border border-slate-700 text-white text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-3 placeholder-slate-500 transition-all"
                                placeholder="seu@email.com"
                                :class="{ 'border-red-500 focus:border-red-500 focus:ring-red-500': form.errors.email }">
                        </div>
                        <p v-if="form.errors.email" class="mt-1 text-sm text-red-400">{{ form.errors.email }}</p>
                    </div>

                    <div class="mb-6">
                        <div class="flex justify-between items-center mb-2">
                            <label for="password" class="block text-sm font-medium text-slate-300">Senha</label>
                        </div>
                        <div class="relative">
                            <div
                                class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-slate-500">
                                <i class="pi pi-lock"></i>
                            </div>

                            <input id="password" v-model="form.password" :type="isVisible ? 'text' : 'password'"
                                required
                                class="w-full bg-slate-950/50 border border-slate-700 text-white text-sm rounded-xl focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 pr-12 p-3 placeholder-slate-500 transition-all"
                                placeholder="••••••••"
                                :class="{ 'border-red-500 focus:border-red-500 focus:ring-red-500': form.errors.password }">

                            <button type="button" @click="toggleVisibility"
                                class="absolute inset-y-0 right-0 pr-3 flex items-center text-slate-500 hover:text-white transition-colors">
                                <i :class="isVisible ? 'pi pi-eye-slash' : 'pi pi-eye'"></i>
                            </button>
                        </div>

                        <p v-if="form.errors.password" class="mt-1 text-sm text-red-400">{{ form.errors.password }}</p>
                    </div>

                    <button type="submit" :disabled="form.processing"
                        class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:ring-blue-800 font-medium rounded-xl text-sm px-5 py-3 text-center transition-all shadow-lg shadow-blue-900/30 flex justify-center items-center"
                        :class="{ 'opacity-70 cursor-not-allowed': form.processing }">
                        <i v-if="form.processing" class="pi pi-spin pi-spinner mr-2"></i>
                        <span v-else>Entrar</span>
                    </button>
                </form>
            </div>

            <div class="mt-6 text-center">
                <p class="text-slate-400 text-sm">
                    Não tem uma conta?
                    <Link href="#" class="text-blue-400 hover:text-blue-300 font-medium transition-colors">
                    Registre-se agora
                    </Link>
                </p>
            </div>
        </div>
    </div>
</template>
