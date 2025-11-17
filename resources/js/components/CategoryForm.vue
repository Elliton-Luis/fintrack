<template>
  <!-- Container Centralizado (simulando um modal ou página de criação) -->
  <div class="w-full max-w-md mx-auto">

    <div class="p-8 rounded-3xl shadow-2xl backdrop-blur-md border border-slate-600 bg-slate-800/30">

      <!-- Cabeçalho -->
      <h2 class="text-2xl font-bold text-white text-center mb-8">Nova Categoria</h2>

      <form @submit.prevent="handleSubmit" class="flex flex-col gap-6">

        <!--
           SELEÇÃO DE ÍCONE (Clicável)
           - Usa um container circular grande no centro.
           - Borda tracejada para indicar "placeholder" ou área de ação.
           - Efeito de hover (group-hover) para mostrar intenção de edição.
        -->
        <div class="flex flex-col items-center justify-center mb-2">
          <div
            class="group relative w-24 h-24 rounded-full bg-slate-700/30 border-2 border-dashed border-slate-500
                   hover:border-blue-500 hover:bg-slate-700/50 transition-all duration-300 cursor-pointer
                   flex items-center justify-center"
            @click="triggerIconPicker"
            title="Alterar Ícone"
          >
            <!-- Ícone Atual -->
            <i :class="['text-4xl text-slate-300 group-hover:text-blue-400 transition-colors', form.icon]"></i>

            <!-- Overlay de Edição (só aparece no hover) -->
            <div class="absolute inset-0 rounded-full bg-black/40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
              <i class="pi pi-pencil text-white text-xl"></i>
            </div>
          </div>
          <span class="text-xs text-slate-400 mt-2">Toque para escolher um ícone</span>
        </div>

        <!-- INPUT: NOME -->
        <div class="flex flex-col gap-2">
          <label for="categoryName" class="text-sm font-medium text-slate-300 ml-1">Nome da Categoria</label>
          <input
            id="categoryName"
            v-model="form.name"
            type="text"
            placeholder="Ex: Viagens, Reserva de Emergência..."
            class="w-full bg-slate-900/50 border border-slate-600 text-white rounded-xl px-4 py-3
                   focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500
                   placeholder-slate-500 transition-colors"
            required
          />
        </div>

        <!-- SELECT: TIPO (Metas ou Transações) -->
        <div class="flex flex-col gap-2">
          <label for="categoryType" class="text-sm font-medium text-slate-300 ml-1">Tipo de Uso</label>
          <div class="relative">
            <select
              id="categoryType"
              v-model="form.type"
              class="w-full appearance-none bg-slate-900/50 border border-slate-600 text-white rounded-xl px-4 py-3
                     focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500
                     cursor-pointer transition-colors"
            >
              <option value="transaction">Transações (Ganhos/Gastos)</option>
              <option value="goal">Metas (Economia)</option>
            </select>
            <!-- Seta customizada -->
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
              <i class="pi pi-chevron-down text-xs"></i>
            </div>
          </div>
        </div>

        <!-- BOTÃO DE AÇÃO -->
        <button
          type="submit"
          class="mt-4 w-full bg-blue-600 hover:bg-blue-500 text-white font-bold py-3.5 rounded-xl
                 shadow-lg shadow-blue-900/20 transition-all duration-200 transform active:scale-[0.98]"
        >
          Criar Categoria
        </button>

      </form>
    </div>

  </div>
</template>

<script>
export default {
  name: 'CategoryForm',
  data() {
    return {
      form: {
        name: '',
        type: 'transaction', // Valor padrão
        icon: 'pi pi-tag'    // Ícone genérico/neutro inicial
      }
    }
  },
  methods: {
    triggerIconPicker() {
      // Lógica para abrir um modal de ícones seria chamada aqui
      // Para demonstração, vamos apenas alternar randomicamente para mostrar que funciona
      console.log('Abrir seletor de ícones...');

      const icons = ['pi pi-shopping-cart', 'pi pi-car', 'pi pi-heart', 'pi pi-globe', 'pi pi-tag'];
      const random = icons[Math.floor(Math.random() * icons.length)];
      this.form.icon = random;

      // Em um cenário real: this.isIconModalOpen = true;
    },
    handleSubmit() {
      console.log('Formulário submetido:', this.form);
      // Emitir evento para o pai com os dados
      this.$emit('create-category', { ...this.form });

      // Resetar formulário (opcional)
      this.form.name = '';
      this.form.icon = 'pi pi-tag';
    }
  }
}
</script>
