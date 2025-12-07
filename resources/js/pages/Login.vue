<script setup>
import { useForm, Link } from '@inertiajs/vue3';
import { ref } from 'vue';
import FlashMessage from '../components/FlashMessage.vue';

const isVisible = ref(false);

const form = useForm({
    email: '',
    password: '',
});

const toggleVisibility = () => {
    isVisible.value = !isVisible.value;
}

const submit = () => {
    form.post('/auth', {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <div class="min-h-screen flex items-center justify-center bg-slate-950 bg-gradient-to-b from-slate-950 to-slate-900 p-4 relative overflow-hidden selection:bg-blue-500/30">

        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full max-w-3xl h-96 bg-blue-600/20 blur-[120px] rounded-full pointer-events-none opacity-40 mix-blend-screen"></div>
        <div class="absolute -bottom-32 right-0 w-96 h-96 bg-blue-500/10 blur-[100px] rounded-full pointer-events-none opacity-30"></div>

        <div class="w-full max-w-md relative z-10">

            <div class="text-center mb-8">
                <h1 class="text-4xl font-bold text-white tracking-tight drop-shadow-lg">FinTrack</h1>
                <p class="text-slate-400 mt-2 text-sm font-medium">Suas finanças sob controle.</p>
            </div>

            <div class="bg-slate-900/60 border border-white/10 ring-1 ring-white/5 backdrop-blur-2xl rounded-2xl shadow-2xl shadow-black/50 p-8 relative overflow-hidden">

                <div class="absolute top-0 left-0 w-full h-px bg-gradient-to-r from-transparent via-white/10 to-transparent"></div>

                <h2 class="text-xl font-semibold text-white mb-8 text-center">Acesse sua conta</h2>

                <FlashMessage />

                <form @submit.prevent="submit" class="space-y-5">

                    <div class="space-y-2">
                        <label for="email" class="block text-xs font-medium text-slate-400 uppercase tracking-wider ml-1">Email</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-500 group-focus-within:text-blue-400 transition-colors duration-300">
                                <i class="pi pi-envelope"></i>
                            </div>
                            <input id="email"
                                v-model="form.email"
                                type="email"
                                required
                                autofocus
                                class="w-full bg-slate-950/50 border border-slate-800 text-white text-sm rounded-xl focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 focus:bg-slate-900/80 block pl-11 p-3.5 placeholder-slate-600 transition-all duration-300 shadow-inner"
                                placeholder="seu@email.com"
                                :class="{ '!border-red-500/50 !focus:ring-red-500/50': form.errors.email }">
                        </div>
                        <p v-if="form.errors.email" class="text-xs text-red-400 ml-1">{{ form.errors.email }}</p>
                    </div>

                    <div class="space-y-2">
                        <div class="flex justify-between items-center ml-1">
                            <label for="password" class="block text-xs font-medium text-slate-400 uppercase tracking-wider">Senha</label>
                        </div>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-slate-500 group-focus-within:text-blue-400 transition-colors duration-300">
                                <i class="pi pi-lock"></i>
                            </div>

                            <input id="password"
                                v-model="form.password"
                                :type="isVisible ? 'text' : 'password'"
                                required
                                class="w-full bg-slate-950/50 border border-slate-800 text-white text-sm rounded-xl focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500/50 focus:bg-slate-900/80 block pl-11 pr-12 p-3.5 placeholder-slate-600 transition-all duration-300 shadow-inner"
                                placeholder="••••••••"
                                :class="{ '!border-red-500/50 !focus:ring-red-500/50': form.errors.password }">

                            <button type="button" @click="toggleVisibility"
                                class="absolute inset-y-0 right-0 pr-4 flex items-center text-slate-600 hover:text-slate-300 transition-colors cursor-pointer outline-none">
                                <i :class="isVisible ? 'pi pi-eye-slash' : 'pi pi-eye'"></i>
                            </button>
                        </div>
                        <p v-if="form.errors.password" class="text-xs text-red-400 ml-1">{{ form.errors.password }}</p>
                    </div>

                    <button type="submit" :disabled="form.processing"
                        class="w-full mt-2 text-white bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-500 hover:to-blue-600 focus:ring-4 focus:ring-blue-900/50 font-semibold rounded-xl text-sm px-5 py-3.5 text-center transition-all duration-300 shadow-lg shadow-blue-900/20 hover:shadow-blue-600/20 hover:-translate-y-0.5 active:translate-y-0"
                        :class="{ 'opacity-70 cursor-not-allowed': form.processing }">
                        <i v-if="form.processing" class="pi pi-spin pi-spinner mr-2"></i>
                        <span v-else>Entrar</span>
                    </button>
                </form>
            </div>

            <div class="mt-8 text-center">
                <p class="text-slate-500 text-sm">
                    Não tem uma conta?
                    <Link href="#" class="text-blue-500 hover:text-blue-400 font-semibold transition-colors ml-1 hover:underline decoration-blue-500/30 underline-offset-4">
                        Registre-se agora
                    </Link>
                </p>
            </div>
        </div>
    </div>
</template>
