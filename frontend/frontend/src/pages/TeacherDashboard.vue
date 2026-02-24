<template>
  <div class="min-h-screen bg-gray-50 dark:bg-slate-900">
    <Navbar />

    <div class="max-w-7xl mx-auto px-6 py-12">
      <h1 class="text-4xl font-bold mb-12">Teacher Dashboard</h1>

      <div class="grid md:grid-cols-2 gap-8">
        <!-- Assign Grade Section -->
        <div>
          <AssignGradeForm @grade-assigned="refreshStudents" />
        </div>

        <!-- Students List -->
        <div class="bg-white dark:bg-slate-950 rounded-lg shadow-lg p-8">
          <h2 class="text-2xl font-bold mb-6">Students</h2>
          <div v-if="loading" class="text-center py-12">
            <p class="text-gray-500">Loading...</p>
          </div>
          <StudentsTable v-else :students="students" />
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { useRouter } from "vue-router";
import { useAuth } from "@/services/composables/useAuth.js";
import { teacherService } from "@/services/api/teacher.service.js";
import Navbar from "@/components/shared/Navbar.vue";
import AssignGradeForm from "@/components/forms/AssignGradeForm.vue";
import StudentsTable from "@/components/tables/StudentsTable.vue";

const router = useRouter();
const { isTeacher } = useAuth();
const loading = ref(false);
const students = ref([]);

const loadStudents = async () => {
  loading.value = true;

  try {
    const response = await teacherService.getStudents();
    students.value = response.etudiants || [];
  } catch (error) {
    console.error("Error loading students:", error);
  } finally {
    loading.value = false;
  }
};

const refreshStudents = () => {
  loadStudents();
};

onMounted(() => {
  if (!isTeacher()) {
    router.push("/");
  }
  loadStudents();
});
</script>
