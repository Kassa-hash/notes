<template>
  <form @submit.prevent="submitForm" class="space-y-6">
    <FormField
      id="teacher-name"
      label="Username"
      type="text"
      placeholder="Enter username"
      v-model="form.name"
      :error="errors.name"
      required
    />

    <FormField
      id="teacher-email"
      label="Email Address"
      type="email"
      placeholder="example@domain.com"
      v-model="form.email"
      :error="errors.email"
      required
    />

    <FormField
      id="teacher-password"
      label="Password"
      type="password"
      placeholder="Minimum 8 characters"
      v-model="form.password"
      :error="errors.password"
      required
    />

    <FormField
      id="teacher-nom"
      label="Full Name"
      type="text"
      placeholder="Enter full name"
      v-model="form.nom"
      :error="errors.nom"
      required
    />

    <FormField
      id="teacher-dateentree"
      label="Entry Date"
      type="date"
      v-model="form.dateentree"
      :error="errors.dateentree"
      required
    />

    <div>
      <label for="matieres" class="text-sm font-semibold leading-6 block">
        Subjects
      </label>
      <select
        id="matieres"
        v-model="form.matieres"
        multiple
        class="mt-2 w-full rounded-md border-0 p-1.5 shadow-sm ring-1 ring-slate-300 focus:outline-none focus:ring-2 focus:ring-orange-500 dark:bg-slate-950 dark:ring-slate-600"
      >
        <option v-for="matiere in matieres" :key="matiere.id" :value="matiere.id">
          {{ matiere.code }}
        </option>
      </select>
      <p v-if="errors.matieres" class="mt-1 text-sm text-red-500">{{ errors.matieres }}</p>
    </div>

    <p v-if="successMessage" class="text-sm text-green-500 font-semibold">{{ successMessage }}</p>
    <p v-if="errorMessage" class="text-sm text-red-500">{{ errorMessage }}</p>

    <button
      type="submit"
      :disabled="loading"
      class="w-full rounded-md bg-orange-500 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-orange-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-orange-500 disabled:opacity-50"
    >
      {{ loading ? "Creating..." : "Create Teacher" }}
    </button>
  </form>
</template>

<script setup>
import { ref } from "vue";
import FormField from "../shared/FormField.vue";
import { adminService } from "@/services/api/admin.service.js";

const form = ref({
  name: "",
  email: "",
  password: "",
  nom: "",
  dateentree: "",
  matieres: [],
});

const loading = ref(false);
const errors = ref({});
const errorMessage = ref("");
const successMessage = ref("");
const matieres = ref([]);

const emit = defineEmits(["teacher-created"]);

const submitForm = async () => {
  loading.value = true;
  errors.value = {};
  errorMessage.value = "";
  successMessage.value = "";

  try {
    await adminService.createTeacher({
      name: form.value.name,
      email: form.value.email,
      password: form.value.password,
      nom: form.value.nom,
      dateentree: form.value.dateentree,
      matieres: form.value.matieres.map(m => parseInt(m)),
    });

    successMessage.value = "Teacher created successfully!";
    form.value = {
      name: "",
      email: "",
      password: "",
      nom: "",
      dateentree: "",
      matieres: [],
    };
    
    emit("teacher-created");
  } catch (error) {
    if (error.errors) {
      errors.value = error.errors;
    } else if (error.message) {
      errorMessage.value = error.message;
    } else {
      errorMessage.value = "Failed to create teacher. Please try again.";
    }
    console.error("Error:", error);
  } finally {
    loading.value = false;
  }
};
</script>
