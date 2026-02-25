<template>
  <nav class="bg-white dark:bg-slate-950 shadow-md">
    <div class="max-w-7xl mx-auto px-6 py-4">
      <div class="flex justify-between items-center">
        <div class="flex items-center gap-3">
          <h1 class="text-2xl font-bold text-orange-500">Gestion de notes</h1>
        </div>
        
        <div class="flex items-center gap-8">
          <div class="hidden md:flex gap-6">
            <router-link 
              v-if="isAdmin" 
              to="/admin-dashboard"
              :class="{ 'text-orange-500': isActive('/admin-dashboard'), 'text-gray-600': !isActive('/admin-dashboard') }"
              class="font-semibold hover:text-orange-500"
            >
              Admin
            </router-link>
            <router-link 
              v-if="isStudent" 
              to="/student-dashboard"
              :class="{ 'text-orange-500': isActive('/student-dashboard'), 'text-gray-600': !isActive('/student-dashboard') }"
              class="font-semibold hover:text-orange-500"
            >
              My Grades
            </router-link>
            <router-link 
              v-if="isTeacher" 
              to="/teacher-dashboard"
              :class="{ 'text-orange-500': isActive('/teacher-dashboard'), 'text-gray-600': !isActive('/teacher-dashboard') }"
              class="font-semibold hover:text-orange-500"
            >
              Teacher
            </router-link>
          </div>

          <div class="relative" @click="isDropdownOpen = !isDropdownOpen">
            <button class="flex items-center gap-2 px-4 py-2 rounded-lg bg-gray-100 dark:bg-slate-900 hover:bg-gray-200 dark:hover:bg-slate-800">
              <span class="text-sm font-semibold">{{ userName }}</span>
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
              </svg>
            </button>

            <div v-if="isDropdownOpen" class="absolute right-0 mt-2 w-48 bg-white dark:bg-slate-900 rounded-lg shadow-lg py-2 z-50">
              <button 
                @click="handleLogout"
                class="w-full text-left px-4 py-2 hover:bg-red-50 dark:hover:bg-red-900 text-red-600 font-semibold"
              >
                Logout
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>
</template>

<script setup>
import { ref, computed } from "vue";
import { useRouter, useRoute } from "vue-router";
import { useAuth } from "@/services/composables/useAuth.js";

const router = useRouter();
const route = useRoute();
const { user, isAdmin, isStudent, isTeacher, logout } = useAuth();
const isDropdownOpen = ref(false);

const userName = computed(() => user.value?.name || "User");

const isActive = (path) => route.path === path;

const handleLogout = async () => {
  try {
    await logout();
    router.push("/");
  } catch (error) {
    console.error("Logout failed:", error);
  }
};
</script>
