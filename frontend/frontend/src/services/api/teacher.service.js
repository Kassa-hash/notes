import axios from "@/axios.js";

export const teacherService = {
  async assignGrade(data) {
    try {
      const response = await axios.post("/api/enseignant/assign-grade", {
        idEtudiant: data.idEtudiant,
        idMatiere: data.idMatiere,
        note: data.note,
      });
      return response.data;
    } catch (error) {
      console.error("Assign grade failed:", error);
      throw error.response?.data || error;
    }
  },

  async getStudents() {
    try {
      const response = await axios.get("/api/enseignant/students");
      return response.data;
    } catch (error) {
      console.error("Get students failed:", error);
      throw error.response?.data || error;
    }
  },
};
