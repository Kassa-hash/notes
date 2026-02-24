<template>
  <div class="rounded-lg py-12 dark:bg-slate-900">
    <div class="mx-auto w-full">
      <div class="flex items-center justify-center gap-3">
        <!-- <img class="size-8" src="/src/assets/logo.svg" alt="Your Brand" /> -->
        <h1 class="pt-1 font-semibold">CVCREATION</h1>
      </div>
      <h2 class="mt-10 text-center text-2xl font-semibold leading-9 tracking-tight">
        Sign in to your account
      </h2>
    </div>
    <div class="m-6 mt-10 flex flex-col justify-center rounded-lg bg-white px-6 py-12 sm:mx-auto sm:w-full sm:max-w-md lg:px-8 dark:bg-slate-950">
      <div class="relative mt-10 w-full">
        <form class="space-y-6" @submit.prevent="login">
          <div>
            <label for="email" class="text-sm font-semibold leading-6">Email address</label>
            <div class="mt-2">
              <input
                v-model="email"
                id="email"
                name="email"
                type="email"
                autocomplete="email"
                placeholder="example@domain.com"
                required
                class="w-full rounded-md border-0 p-1.5 shadow-sm ring-1 ring-slate-300 placeholder:text-slate-300 focus:outline-none focus:ring-2 focus:ring-orange-500 sm:text-sm sm:leading-6 dark:bg-slate-950 dark:ring-slate-600 dark:placeholder:text-slate-600"
              />
            </div>
          </div>

          <div>
            <div class="flex items-center justify-between">
              <label for="password" class="text-sm font-semibold leading-6">Password</label>
              <div class="text-sm">
                <a href="#" class="font-semibold text-orange-500 hover:text-orange-600">
                  Forgot password?
                </a>
              </div>
            </div>
            <div class="mt-2">
              <input
                v-model="password"
                id="password"
                name="password"
                type="password"
                autocomplete="current-password"
                placeholder="********"
                required
                class="w-full rounded-md border-0 p-1.5 shadow-sm ring-1 ring-slate-300 placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-orange-500 dark:bg-slate-950 dark:ring-slate-600 dark:placeholder:text-slate-600"
              />
            </div>
          </div>

          <p v-if="errorMessage" class="text-sm text-red-500">{{ errorMessage }}</p>

          <div>
            <button
              type="submit"
              :disabled="loading"
              class="flex w-full justify-center rounded-md bg-orange-500 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-orange-600 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-orange-500 disabled:opacity-50"
            >
              {{ loading ? "Signing in..." : "Sign In" }}
            </button>
          </div>
        </form>
      </div>
    </div>
    <p class="mt-10 text-center text-sm dark:text-white">
      First Time Here?
      <a href="#" class="inline-flex font-semibold leading-6 text-orange-500 hover:text-orange-600">
        Register Today!
      </a>
    </p>
  </div>
</template>

<script setup>
import { ref } from "vue";
import { useRouter } from "vue-router";
import axios from "@/axios.js";

const email = ref("");
const password = ref("");
const loading = ref(false);
const errorMessage = ref("");
const router = useRouter();

const login = async () => {
    loading.value = true;
    errorMessage.value = "";

    try {
        await axios.get("/sanctum/csrf-cookie");
        await axios.post("/login", {
            email: email.value,
            password: password.value,
        });

        const response = await axios.get("/api/user");
        console.log("Utilisateur connecté :", response.data);

        router.push("/welcome");
    } catch (error) {
        console.error("Login failed:", error);
        errorMessage.value = error.response?.data?.message || "Login failed. Please try again.";
    } finally {
        loading.value = false;
    }
};
</script>