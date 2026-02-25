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

   async getPromotions() {
    try {
      const response = await axios.get("/api/admin/promotions");
      return response.data;
    } catch (error) {
      console.error("Get promotions failed:", error);
      throw error.response?.data || error;
    }
  },

  async getClasses() {
    try {
      const response = await axios.get("/api/admin/classes");
      return response.data;
    } catch (error) {
      console.error("Get classes failed:", error);
      throw error.response?.data || error;
    }
  },

    async getMatieres() {
        try {
      const response = await axios.get("/api/admin/matieres");
      return response.data;
    } catch (error) {
      console.error("Get matieres failed:", error);
      throw error.response?.data || error;
    }
    }
};
