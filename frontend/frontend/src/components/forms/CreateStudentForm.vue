<template>
  <form @submit.prevent="submitForm" class="space-y-6">
    <FormField
      id="student-name"
      label="Username"
      type="text"
      placeholder="Enter username"
      v-model="form.name"
      :error="errors.name"
      required
    />

    <FormField
      id="student-email"
      label="Email Address"
      type="email"
      placeholder="example@domain.com"
      v-model="form.email"
      :error="errors.email"
      required
    />

    <FormField
      id="student-password"
      label="Password"
      type="password"
      placeholder="Minimum 8 characters"
      v-model="form.password"
      :error="errors.password"
      required
    />

    <FormField
      id="student-nom"
      label="Full Name"
      type="text"
      placeholder="Enter full name"
      v-model="form.nom"
      :error="errors.nom"
      required
    />

    <FormField
      id="student-dtn"
      label="Date of Birth"
      type="date"
      v-model="form.dtn"
      :error="errors.dtn"
      required
    />

    <div>
      <label for="promotion" class="text-sm font-semibold leading-6 block">
        Promotion <span class="text-red-500">*</span>
      </label>
      <select
        id="promotion"
        v-model="form.idpromotion"
        class="mt-2 w-full rounded-md border-0 p-1.5 shadow-sm ring-1 ring-slate-300 focus:outline-none focus:ring-2 focus:ring-orange-500 dark:bg-slate-950 dark:ring-slate-600"
        required
      >
        <option value="">Select a promotion</option>
        <option v-for="promo in promotions" :key="promo.id" :value="promo.id">
          {{ promo.libelle }}
        </option>
      </select>
      <p v-if="errors.idpromotion" class="mt-1 text-sm text-red-500">{{ errors.idpromotion }}</p>
    </div>

    <div>
      <label for="classe" class="text-sm font-semibold leading-6 block">
        Class <span class="text-red-500">*</span>
      </label>
      <select
        id="classe"
        v-model="form.idclasse"
        class="mt-2 w-full rounded-md border-0 p-1.5 shadow-sm ring-1 ring-slate-300 focus:outline-none focus:ring-2 focus:ring-orange-500 dark:bg-slate-950 dark:ring-slate-600"
        required
      >
        <option value="">Select a class</option>
        <option v-for="classe in classes" :key="classe.id" :value="classe.id">
          {{ classe.libelle }}
        </option>
      </select>
      <p v-if="errors.idclasse" class="mt-1 text-sm text-red-500">{{ errors.idclasse }}</p>
    </div>

    <p v-if="successMessage" class="text-sm text-green-500 font-semibold">{{ successMessage }}</p>
    <p v-if="errorMessage" class="text-sm text-red-500">{{ errorMessage }}</p>

    <button
      type="submit"
      :disabled="loading"
      class="w-full rounded-md bg-orange-500 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-orange-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-orange-500 disabled:opacity-50"
    >
      {{ loading ? "Creating..." : "Create Student" }}
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
  dtn: "",
  idpromotion: "",
  idclasse: "",
});

const loading = ref(false);
const errors = ref({});
const errorMessage = ref("");
const successMessage = ref("");
const promotions = ref([]);
const classes = ref([]);

const emit = defineEmits(["student-created"]);

const submitForm = async () => {
  loading.value = true;
  errors.value = {};
  errorMessage.value = "";
  successMessage.value = "";

  try {
    await adminService.createStudent({
      name: form.value.name,
      email: form.value.email,
      password: form.value.password,
      nom: form.value.nom,
      dtn: form.value.dtn,
      idpromotion: parseInt(form.value.idpromotion),
      idclasse: parseInt(form.value.idclasse),
    });

    successMessage.value = "Student created successfully!";
    form.value = {
      name: "",
      email: "",
      password: "",
      nom: "",
      dtn: "",
      idpromotion: "",
      idclasse: "",
    };
    
    emit("student-created");
  } catch (error) {
    if (error.errors) {
      errors.value = error.errors;
    } else if (error.message) {
      errorMessage.value = error.message;
    } else {
      errorMessage.value = "Failed to create student. Please try again.";
    }
    console.error("Error:", error);
  } finally {
    loading.value = false;
  }
};
</script>
