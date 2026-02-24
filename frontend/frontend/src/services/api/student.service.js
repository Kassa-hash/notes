import axios from "@/axios.js";

export const studentService = {
  async getMyGrades() {
    try {
      const response = await axios.get("/api/etudiant/grades");
      return response.data;
    } catch (error) {
      console.error("Get grades failed:", error);
      throw error.response?.data || error;
    }
  },
};
