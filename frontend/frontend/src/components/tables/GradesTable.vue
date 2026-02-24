<template>
  <div class="bg-white dark:bg-slate-950 rounded-lg shadow-md overflow-hidden">
    <div class="overflow-x-auto">
      <table class="w-full text-sm">
        <thead class="bg-gray-50 dark:bg-slate-900 border-b border-gray-200 dark:border-slate-700">
          <tr>
            <th class="px-6 py-3 text-left font-semibold">Subject</th>
            <th class="px-6 py-3 text-left font-semibold">Grade</th>
            <th class="px-6 py-3 text-left font-semibold">Coefficient</th>
            <th class="px-6 py-3 text-left font-semibold">Date</th>
          </tr>
        </thead>
        <tbody>
          <tr v-if="!notes || notes.length === 0" class="border-b dark:border-slate-700">
            <td colspan="4" class="px-6 py-4 text-center text-gray-500">No grades yet</td>
          </tr>
          <tr v-for="note in notes" :key="note.id" class="border-b dark:border-slate-700 hover:bg-gray-50 dark:hover:bg-slate-900">
            <td class="px-6 py-4">{{ note.matiere?.code || "N/A" }}</td>
            <td class="px-6 py-4">
              <span :class="getGradeColor(note.note)">{{ note.note }}/20</span>
            </td>
            <td class="px-6 py-4">{{ note.matiere?.coeff || "N/A" }}</td>
            <td class="px-6 py-4 text-gray-500">{{ formatDate(note.created_at) }}</td>
          </tr>
        </tbody>
      </table>
    </div>
    <div v-if="notes && notes.length > 0" class="px-6 py-4 bg-gray-50 dark:bg-slate-900 border-t border-gray-200 dark:border-slate-700">
      <p class="font-semibold">Average: <span :class="getAverageColor(calculateAverage())">{{ calculateAverage().toFixed(2) }}/20</span></p>
    </div>
  </div>
</template>

<script setup>
const props = defineProps({
  notes: {
    type: Array,
    default: () => [],
  },
});

const formatDate = (date) => {
  if (!date) return "N/A";
  return new Date(date).toLocaleDateString();
};

const calculateAverage = () => {
  if (props.notes.length === 0) return 0;
  const sum = props.notes.reduce((acc, note) => acc + note.note, 0);
  return sum / props.notes.length;
};

const getGradeColor = (grade) => {
  if (grade >= 18) return "text-green-600 font-semibold";
  if (grade >= 16) return "text-blue-600 font-semibold";
  if (grade >= 14) return "text-orange-600 font-semibold";
  return "text-red-600 font-semibold";
};

const getAverageColor = (average) => {
  if (average >= 18) return "text-green-600 font-bold";
  if (average >= 16) return "text-blue-600 font-bold";
  if (average >= 14) return "text-orange-600 font-bold";
  return "text-red-600 font-bold";
};
</script>
