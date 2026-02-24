import { ref } from "vue";
import { authService } from "../api/auth.service.js";

const user = ref(null);
const roles = ref([]);
const isLoading = ref(false);

export function useAuth() {
  const logout = async () => {
    try {
      isLoading.value = true;
      await authService.logout();
      user.value = null;
      roles.value = [];
      localStorage.removeItem("user");
      localStorage.removeItem("roles");
      return true;
    } catch (error) {
      console.error("Logout error:", error);
      throw error;
    } finally {
      isLoading.value = false;
    }
  };

  const loadUser = async () => {
    try {
      isLoading.value = true;
      const data = await authService.getCurrentUser();
      user.value = data.user;
      roles.value = data.roles || [];
      localStorage.setItem("user", JSON.stringify(data.user));
      localStorage.setItem("roles", JSON.stringify(data.roles));
      return data;
    } catch (error) {
      console.error("Load user error:", error);
      throw error;
    } finally {
      isLoading.value = false;
    }
  };

  const isAdmin = () => roles.value.includes("admin");
  const isStudent = () => roles.value.includes("etudiant");
  const isTeacher = () => roles.value.includes("enseignant");
  const hasRole = (role) => roles.value.includes(role);

  return {
    user,
    roles,
    isLoading,
    logout,
    loadUser,
    isAdmin,
    isStudent,
    isTeacher,
    hasRole,
  };
}
