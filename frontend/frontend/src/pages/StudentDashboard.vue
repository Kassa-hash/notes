<template>
  <div class="min-h-screen bg-gray-50 dark:bg-slate-900">
    <Navbar />

    <div class="max-w-7xl mx-auto px-6 py-12">
      <h1 class="text-4xl font-bold mb-8">My Grades</h1>

      <div v-if="loading" class="text-center py-12">
        <p class="text-lg text-gray-500">Loading...</p>
      </div>

      <div v-else class="space-y-8">
        <!-- Student Info -->
        <div class="bg-white dark:bg-slate-950 rounded-lg shadow-lg p-8">
          <h2 class="text-2xl font-bold mb-4">Student Information</h2>
          <div class="grid md:grid-cols-3 gap-4">
            <div>
              <p class="text-gray-600 dark:text-gray-400">Name</p>
              <p class="text-xl font-semibold">{{ student?.nom }}</p>
            </div>
            <div>
              <p class="text-gray-600 dark:text-gray-400">Class</p>
              <p class="text-xl font-semibold">{{ student?.classe?.libelle }}</p>
            </div>
            <div>
              <p class="text-gray-600 dark:text-gray-400">Promotion</p>
              <p class="text-xl font-semibold">{{ student?.promotion?.libelle }}</p>
            </div>
          </div>
        </div>

        <!-- Grades Table -->
        <div class="bg-white dark:bg-slate-950 rounded-lg shadow-lg p-8">
          <h2 class="text-2xl font-bold mb-6">Grades</h2>
          <GradesTable :notes="notes" />
        </div>
      </div>

      <div v-if="error" class="text-center text-red-600 font-semibold mt-8">
        {{ error }}
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { useRouter } from "vue-router";
import { useAuth } from "@/services/composables/useAuth.js";
import { studentService } from "@/services/api/student.service.js";
import Navbar from "@/components/shared/Navbar.vue";
import GradesTable from "@/components/tables/GradesTable.vue";

const router = useRouter();
const { isStudent } = useAuth();
const loading = ref(false);
const error = ref("");
const student = ref(null);
const notes = ref([]);

const loadGrades = async () => {
  loading.value = true;
  error.value = "";

  try {
    const response = await studentService.getMyGrades();
    student.value = response.etudiant;
    notes.value = response.notes || [];
  } catch (err) {
    console.error("Error loading grades:", err);
    error.value = "Failed to load grades. Please try again.";
  } finally {
    loading.value = false;
  }
};

onMounted(() => {
  if (!isStudent()) {
    router.push("/");
  }
  loadGrades();
});
</script>
