<template>
  <form @submit.prevent="submitForm" class="space-y-6 bg-white dark:bg-slate-950 p-6 rounded-lg shadow-md">
    <h3 class="text-xl font-semibold mb-6">Assign Grade to Student</h3>

    <div>
      <label for="etudiant" class="text-sm font-semibold leading-6 block">
        Student <span class="text-red-500">*</span>
      </label>
      <select
        id="etudiant"
        v-model="form.idEtudiant"
        class="mt-2 w-full rounded-md border-0 p-1.5 shadow-sm ring-1 ring-slate-300 focus:outline-none focus:ring-2 focus:ring-orange-500 dark:bg-slate-950 dark:ring-slate-600"
        required
      >
        <option value="">Select a student</option>
        <option v-for="etudiant in etudiants" :key="etudiant.id" :value="etudiant.id">
          {{ etudiant.nom }} ({{ etudiant.classe?.libelle }})
        </option>
      </select>
      <p v-if="errors.idEtudiant" class="mt-1 text-sm text-red-500">{{ errors.idEtudiant }}</p>
    </div>

    <div>
      <label for="matiere" class="text-sm font-semibold leading-6 block">
        Subject <span class="text-red-500">*</span>
      </label>
      <select
        id="matiere"
        v-model="form.idMatiere"
        class="mt-2 w-full rounded-md border-0 p-1.5 shadow-sm ring-1 ring-slate-300 focus:outline-none focus:ring-2 focus:ring-orange-500 dark:bg-slate-950 dark:ring-slate-600"
        required
      >
        <option value="">Select a subject</option>
        <option v-for="matiere in enseignantMatieres" :key="matiere.id" :value="matiere.id">
          {{ matiere.code }}
        </option>
      </select>
      <p v-if="errors.idMatiere" class="mt-1 text-sm text-red-500">{{ errors.idMatiere }}</p>
    </div>

    <FormField
      id="grade-note"
      label="Grade (0-20)"
      type="number"
      placeholder="Enter grade between 0 and 20"
      v-model.number="form.note"
      :error="errors.note"
      required
    />

    <p v-if="successMessage" class="text-sm text-green-500 font-semibold">{{ successMessage }}</p>
    <p v-if="errorMessage" class="text-sm text-red-500">{{ errorMessage }}</p>

    <button
      type="submit"
      :disabled="loading"
      class="w-full rounded-md bg-orange-500 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-orange-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-orange-500 disabled:opacity-50"
    >
      {{ loading ? "Assigning..." : "Assign Grade" }}
    </button>
  </form>
</template>

<script setup>
import { ref, onMounted } from "vue";
import FormField from "../shared/FormField.vue";
import { teacherService } from "@/services/api/teacher.service.js";

const form = ref({
  idEtudiant: "",
  idMatiere: "",
  note: "",
});

const loading = ref(false);
const errors = ref({});
const errorMessage = ref("");
const successMessage = ref("");
const etudiants = ref([]);
const enseignantMatieres = ref([]);

const emit = defineEmits(["grade-assigned"]);

const loadData = async () => {
  try {
    const response = await teacherService.getStudents();
    etudiants.value = response.etudiants || [];
    enseignantMatieres.value = response.enseignant?.matieres || [];
  } catch (error) {
    console.error("Error loading data:", error);
    errorMessage.value = "Failed to load data";
  }
};

const submitForm = async () => {
  loading.value = true;
  errors.value = {};
  errorMessage.value = "";
  successMessage.value = "";

  try {
    await teacherService.assignGrade({
      idEtudiant: parseInt(form.value.idEtudiant),
      idMatiere: parseInt(form.value.idMatiere),
      note: parseFloat(form.value.note),
    });

    successMessage.value = "Grade assigned successfully!";
    form.value = {
      idEtudiant: "",
      idMatiere: "",
      note: "",
    };
    
    emit("grade-assigned");
  } catch (error) {
    if (error.errors) {
      errors.value = error.errors;
    } else if (error.message) {
      errorMessage.value = error.message;
    } else {
      errorMessage.value = "Failed to assign grade. Please try again.";
    }
    console.error("Error:", error);
  } finally {
    loading.value = false;
  }
};

onMounted(() => {
  loadData();
});
</script>
