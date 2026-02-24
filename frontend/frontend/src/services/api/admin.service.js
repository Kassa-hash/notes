import axios from "@/axios.js";

export const adminService = {
  async createStudent(data) {
    try {
      const response = await axios.post("/api/admin/students", {
        name: data.name,
        email: data.email,
        password: data.password,
        nom: data.nom,
        dtn: data.dtn,
        idpromotion: data.idpromotion,
        idclasse: data.idclasse,
      });
      return response.data;
    } catch (error) {
      console.error("Create student failed:", error);
      throw error.response?.data || error;
    }
  },

  async createTeacher(data) {
    try {
      const response = await axios.post("/api/admin/teachers", {
        name: data.name,
        email: data.email,
        password: data.password,
        nom: data.nom,
        dateentree: data.dateentree,
        matieres: data.matieres || [],
      });
      return response.data;
    } catch (error) {
      console.error("Create teacher failed:", error);
      throw error.response?.data || error;
    }
  },
};
