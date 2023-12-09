<script setup>
import { Link } from '@inertiajs/vue3'
import AppLogoXeniaWeb from '@/Components/AppLogoXeniaWeb.vue'
</script>

<template>
  <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
    <div>
      <Link href="/" class="text-primary-500">
        <AppLogoXeniaWeb color-xenia="inherit" class="w-32 h-auto fill-current" />
      </Link>
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
      <slot />
    </div>
  </div>
</template>
