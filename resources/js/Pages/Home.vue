<script setup>
import Card from 'primevue/card';
import Button from 'primevue/button';
</script>

<template>
    <div class="flex justify-center items-center h-screen w-screen">
        <Card style="width: 25rem; overflow: hidden">
            <template #header>
                <img alt="user header" src="https://primefaces.org/cdn/primevue/images/usercard.png" />
            </template>
            <template #title>Laravel - Inertia - VueJS - PrimeVue</template>
            <template #subtitle>StarterKit made by MutoLucas</template>
            <template #content>
                <p class="m-0">
                    StarterKit with Larave for BackEnd, Inertia + VueJs for FrontEnd and PrimeVue for beautifull components on FrontEnd
                </p>
            </template>
            <template #footer>
                <div class="flex justify-center mt-1">
                    <Button as="a" target="_blank" href="https://github.com/MutoLucas/Starter-Kit-Laravel-Inertia-VueJs" class="w-1/2">
                        <i class="pi pi-github"></i>
                        GitHub
                    </Button>
                </div>
            </template>
        </Card>
    </div>
</template>


