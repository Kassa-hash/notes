import axios from "axios";

const instance = axios.create({
    baseURL: "http://localhost:8000",
    withCredentials: true,
    headers: {
        "Content-Type": "application/json",
        "Accept": "application/json",
    },
});

// Get CSRF token from cookie and include in headers
instance.interceptors.request.use((config) => {
    const token = document.cookie
        .split("; ")
        .find((row) => row.startsWith("XSRF-TOKEN="))
        ?.split("=")[1];

    if (token) {
        config.headers["X-XSRF-TOKEN"] = decodeURIComponent(token);
    }

    return config;
});

export default instance;