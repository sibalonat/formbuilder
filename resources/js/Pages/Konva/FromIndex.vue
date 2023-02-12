<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
</script>
<template>

    <Head title="Forms" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Forms</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg h-[60vh]">
                    <div class="grid grid-cols-3">
                        <div class="px-4 bg-slate-600 h-full my-auto">
                            <Link :href="route('form.create')" class="button flex py-8 mt-auto">
                                <span class="desktop-text">Create</span>
                            </Link>
                        </div>
                        <p>

                        </p>

                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>

</template>
