import axios from "@/axios.js";

export const authService = {
  async logout() {
    try {
      await axios.post("/logout");
    } catch (error) {
      console.error("Logout failed:", error);
      throw error;
    }
  },

  async getCurrentUser() {
    try {
      const response = await axios.get("/api/user");
      return response.data;
    } catch (error) {
      console.error("Get user failed:", error);
      throw error;
    }
  },

  async getMyRoles() {
    try {
      const response = await axios.get("/api/user");
      return response.data.roles || [];
    } catch (error) {
      console.error("Get roles failed:", error);
      throw error;
    }
  },
};
