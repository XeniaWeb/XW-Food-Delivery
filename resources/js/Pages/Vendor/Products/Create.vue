<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue'
import { Head, Link, useForm } from '@inertiajs/vue3'
import InputError from '@/Components/InputError.vue'
import InputLabel from '@/Components/InputLabel.vue'
import PrimaryButton from '@/Components/PrimaryButton.vue'
import TextInput from '@/Components/TextInput.vue'
import SelectInput from '@/Components/SelectInput.vue'

const props = defineProps({
  category: {
    type: Object
  },
  categories: {
    type: Array
  }
})
const form = useForm({
  category_id: props.category.id,
  name: '',
  price: ''
})

const submit = () => {
  form.post(route('vendor.products.store'))
}
</script>

<template>
  <Head :title="'Add Product to ' + props.category.name" />

  <AuthenticatedLayout>
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ 'Add new Product to Category: "' + props.category.name + '"' }}
      </h2>
    </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 text-gray-900 overflow-x-auto">
            <div class="p-6 text-gray-900 overflow-x-auto">
              <form @submit.prevent="submit" class="flex flex-col gap-4">
                <div class="form-group">
                  <InputLabel for="category_id" value="Category" />
                  <SelectInput
                    id="category_id"
                    v-model="form.category_id"
                    option-label="name"
                    option-value="id"
                    :options="categories"
                    :disabled="form.processing"
                  />
                </div>
                <div class="form-group">
                  <InputLabel for="name" value="Name" />
                  <TextInput
                    id="name"
                    type="text"
                    v-model="form.name"
                    :disabled="form.processing"
                  />
                  <InputError :message="form.errors.name" />
                </div>
                <div class="form-group">
                  <InputLabel for="price" value="Price" />
                  <TextInput
                    id="price"
                    type="text"
                    v-model="form.price"
                    :disabled="form.processing"
                  />
                  <InputError :message="form.errors.price" />
                </div>
                <div class="flex justify-between">
                  <div>
                    <PrimaryButton :processing="form.processing">
                      Create New Product Category
                    </PrimaryButton>
                  </div>
                  <div class="">
                    <Link :href="route('vendor.menu')" class="btn btn-warning btn-sm"> Cancel</Link>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AuthenticatedLayout>
</template>
