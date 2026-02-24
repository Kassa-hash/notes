<template>
  <div class="min-h-screen bg-gray-50 dark:bg-slate-900">
    <Navbar />

    <div class="max-w-7xl mx-auto px-6 py-12">
      <h1 class="text-4xl font-bold mb-12">Admin Dashboard</h1>

      <div class="grid md:grid-cols-2 gap-8">
        <!-- Create Student Section -->
        <div class="bg-white dark:bg-slate-950 rounded-lg shadow-lg p-8">
          <h2 class="text-2xl font-bold mb-6">Create Student</h2>
          <CreateStudentForm @student-created="refreshStudents" />
        </div>

        <!-- Create Teacher Section -->
        <div class="bg-white dark:bg-slate-950 rounded-lg shadow-lg p-8">
          <h2 class="text-2xl font-bold mb-6">Create Teacher</h2>
          <CreateTeacherForm @teacher-created="refreshTeachers" />
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { onMounted } from "vue";
import { useRouter } from "vue-router";
import { useAuth } from "@/services/composables/useAuth.js";
import Navbar from "@/components/shared/Navbar.vue";
import CreateStudentForm from "@/components/forms/CreateStudentForm.vue";
import CreateTeacherForm from "@/components/forms/CreateTeacherForm.vue";

const router = useRouter();
const { isAdmin } = useAuth();

const refreshStudents = () => {
  console.log("Student created");
};

const refreshTeachers = () => {
  console.log("Teacher created");
};

onMounted(() => {
  if (!isAdmin()) {
    router.push("/");
  }
});
</script>
