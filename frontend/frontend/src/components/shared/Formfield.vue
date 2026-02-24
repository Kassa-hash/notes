<template>
  <div>
    <label :for="id" class="text-sm font-semibold leading-6 block">
      {{ label }}
      <span v-if="required" class="text-red-500">*</span>
    </label>
    <div class="mt-2">
      <input
        v-if="type !== 'textarea'"
        :id="id"
        :type="type"
        :value="modelValue"
        :placeholder="placeholder"
        :required="required"
        @input="$emit('update:modelValue', $event.target.value)"
        class="w-full rounded-md border-0 p-1.5 shadow-sm ring-1 ring-slate-300 placeholder:text-slate-300 focus:outline-none focus:ring-2 focus:ring-orange-500 sm:text-sm sm:leading-6 dark:bg-slate-950 dark:ring-slate-600 dark:placeholder:text-slate-600"
      />
      <textarea
        v-else
        :id="id"
        :value="modelValue"
        :placeholder="placeholder"
        :required="required"
        @input="$emit('update:modelValue', $event.target.value)"
        rows="4"
        class="w-full rounded-md border-0 p-1.5 shadow-sm ring-1 ring-slate-300 placeholder:text-slate-300 focus:outline-none focus:ring-2 focus:ring-orange-500 sm:text-sm sm:leading-6 dark:bg-slate-950 dark:ring-slate-600 dark:placeholder:text-slate-600"
      ></textarea>
    </div>
    <p v-if="error" class="mt-1 text-sm text-red-500">
      {{ error }}
    </p>
  </div>
</template>

<script setup>
defineProps({
  id: {
    type: String,
    required: true,
  },
  label: {
    type: String,
    required: true,
  },
  type: {
    type: String,
    default: "text",
  },
  placeholder: {
    type: String,
    default: "",
  },
  modelValue: {
    type: [String, Number],
    default: "",
  },
  error: {
    type: String,
    default: "",
  },
  required: {
    type: Boolean,
    default: false,
  },
});

defineEmits(["update:modelValue"]);
</script>
