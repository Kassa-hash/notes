<template>
  <div class="bg-white dark:bg-slate-950 rounded-lg shadow-md overflow-hidden">
    <div class="overflow-x-auto">
      <table class="w-full text-sm">
        <thead class="bg-gray-50 dark:bg-slate-900 border-b border-gray-200 dark:border-slate-700">
          <tr>
            <th class="px-6 py-3 text-left font-semibold">ID</th>
            <th class="px-6 py-3 text-left font-semibold">Name</th>
            <th class="px-6 py-3 text-left font-semibold">Class</th>
            <th class="px-6 py-3 text-left font-semibold">Promotion</th>
            <th class="px-6 py-3 text-left font-semibold">Grades Count</th>
          </tr>
        </thead>
        <tbody>
          <tr v-if="!students || students.length === 0" class="border-b dark:border-slate-700">
            <td colspan="5" class="px-6 py-4 text-center text-gray-500">No students found</td>
          </tr>
          <tr v-for="student in students" :key="student.id" class="border-b dark:border-slate-700 hover:bg-gray-50 dark:hover:bg-slate-900">
            <td class="px-6 py-4">{{ student.id }}</td>
            <td class="px-6 py-4 font-semibold">{{ student.nom }}</td>
            <td class="px-6 py-4">{{ student.classe?.libelle || "N/A" }}</td>
            <td class="px-6 py-4">{{ student.promotion?.libelle || "N/A" }}</td>
            <td class="px-6 py-4">
              <span class="inline-block px-2 py-1 bg-orange-100 dark:bg-orange-900 text-orange-700 dark:text-orange-100 rounded">
                {{ student.notes?.length || 0 }}
              </span>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script setup>
defineProps({
  students: {
    type: Array,
    default: () => [],
  },
});
</script>
